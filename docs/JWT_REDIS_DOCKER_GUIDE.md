# Hướng Dẫn Triển Khai JWT + Redis + Docker

> Tài liệu mô tả chi tiết quy trình thiết lập xác thực JWT (xoay vòng access + refresh token),  
> cache phiên Redis, và Docker hoá toàn bộ môi trường phát triển.

---

## Mục Lục

1. [Tổng Quan Kiến Trúc](#1-tổng-quan-kiến-trúc)
2. [Cài Đặt Nhanh Với Docker](#2-cài-đặt-nhanh-với-docker)
3. [Cài Đặt Thủ Công (Không Docker)](#3-cài-đặt-thủ-công-không-docker)
4. [Chi Tiết Xác Thực JWT](#4-chi-tiết-xác-thực-jwt)
5. [Redis — Cache Phiên & Blacklist Token](#5-redis--cache-phiên--blacklist-token)
6. [API Endpoints](#6-api-endpoints)
7. [Luồng Xác Thực Client-Side](#7-luồng-xác-thực-client-side)
8. [Cấu Trúc File Đã Thay Đổi / Thêm Mới](#8-cấu-trúc-file-đã-thay-đổi--thêm-mới)
9. [Xử Lý Lỗi Thường Gặp](#9-xử-lý-lỗi-thường-gặp)

---

## 1. Tổng Quan Kiến Trúc

```
┌──────────┐     HTTP      ┌─────────┐    FastCGI   ┌──────────────┐
│  Client  │ ──────────▸   │  Nginx  │ ──────────▸  │  PHP-FPM     │
│ (Browser │     :8080     │  :80    │     :9000    │  Laravel 12  │
│  / App)  │               └─────────┘              │              │
└──────────┘                                        │  ┌────────┐  │
                                                    │  │JWT Auth│  │
                                                    │  └───┬────┘  │
                                                    │      │       │
                                                    └──────┼───────┘
                                                           │
                                        ┌──────────────────┼──────────────────┐
                                        │                  │                  │
                                   ┌────▼────┐       ┌─────▼─────┐     ┌─────▼─────┐
                                   │  MySQL  │       │   Redis   │     │   Redis   │
                                   │  :3306  │       │  DB 0     │     │  DB 1     │
                                   │ (Data)  │       │(Blacklist)│     │ (Cache/   │
                                   └─────────┘       └───────────┘     │  Session) │
                                                                       └───────────┘
```

**Luồng token xoay vòng:**

```
Client                          Server (Laravel)                     Redis
  │                                  │                                 │
  │── POST /api/auth/login ────────▸ │                                 │
  │                                  │── Verify credentials ──▸ MySQL  │
  │                                  │◂── User data ──────────         │
  │                                  │── Cache user session ──────────▸│ SET user_session:{id}
  │◂── { access_token, expires_in }──│                                 │
  │                                  │                                 │
  │── GET /api/auth/me ────────────▸ │                                 │
  │   Authorization: Bearer {token}  │── GET user_session:{id} ──────▸│
  │                                  │◂── Cached user data ───────────│ (No DB query!)
  │◂── { user data } ───────────────│                                 │
  │                                  │                                 │
  │   ⏰ Token hết hạn (60 phút)    │                                 │
  │                                  │                                 │
  │── POST /api/auth/refresh ──────▸ │                                 │
  │   Authorization: Bearer {old}    │── Blacklist old token ────────▸│ SET blacklist:{jti}
  │                                  │── Cache new session ──────────▸│ SET user_session:{id}
  │◂── { new access_token } ────────│                                 │
  │                                  │                                 │
  │── POST /api/auth/logout ───────▸ │                                 │
  │                                  │── Blacklist token ────────────▸│
  │                                  │── DEL user_session:{id} ──────▸│
  │◂── { message: "Đăng xuất" } ───│                                 │
```

---

## 2. Cài Đặt Nhanh Với Docker

### Yêu cầu

- **Docker Desktop** ≥ 4.x (Windows/Mac) hoặc Docker Engine ≥ 24.x (Linux)
- **Docker Compose** v2 (đã tích hợp sẵn trong Docker Desktop)

### Các bước

```powershell
# 1. Clone project
git clone <repo-url> && cd DATTCN_QuanLyBangHang

# 2. Tạo file .env từ template Docker
copy .env.docker .env            # Windows
# cp .env.docker .env            # Linux/Mac

# 3. Khởi chạy containers
docker compose up -d --build

# 4. Vào container app để setup Laravel
docker compose exec app bash

# Bên trong container:
composer install
php artisan key:generate
php artisan jwt:secret            # ← Quan trọng: sinh JWT_SECRET
php artisan migrate --seed
php artisan storage:link
exit

# 5. Truy cập
# Web:  http://localhost:8080
# API:  http://localhost:8080/api/auth/login
# Vite: http://localhost:5173
```

### Lệnh Docker hay dùng

```powershell
# Xem logs
docker compose logs -f app

# Dừng tất cả
docker compose down

# Dừng + xóa database volume
docker compose down -v

# Rebuild khi thay đổi Dockerfile
docker compose up -d --build app

# Chạy artisan command
docker compose exec app php artisan migrate

# Truy cập Redis CLI
docker compose exec redis redis-cli

# Truy cập MySQL
docker compose exec mysql mysql -u laravel -psecret doan_thuctap_cn
```

### Cổng mặc định

| Service | Cổng Host | Cổng Container |
|---------|-----------|----------------|
| Nginx   | 8080      | 80             |
| MySQL   | 3307      | 3306           |
| Redis   | 6380      | 6379           |
| Vite    | 5173      | 5173           |

> Tuỳ chỉnh cổng bằng biến môi trường: `APP_PORT`, `DB_EXTERNAL_PORT`, `REDIS_EXTERNAL_PORT`, `VITE_PORT`

---

## 3. Cài Đặt Thủ Công (Không Docker)

### Yêu cầu

- PHP ≥ 8.2 + extensions: `pdo_mysql`, `mbstring`, `openssl`, `json`, `redis` (hoặc dùng predis)
- Composer ≥ 2.x
- MySQL ≥ 8.0
- Redis ≥ 6.x
- Node.js ≥ 18.x

### Các bước

```powershell
# 1. Cài PHP dependencies
composer install

# 2. Cấu hình .env
copy .env.example .env

# 3. Chỉnh sửa .env:
#    - DB_HOST=127.0.0.1, DB_DATABASE=doan_thuctap_cn, DB_USERNAME=root, DB_PASSWORD=
#    - SESSION_DRIVER=redis
#    - CACHE_STORE=redis
#    - REDIS_CLIENT=predis   (hoặc phpredis nếu đã cài extension)
#    - REDIS_HOST=127.0.0.1

# 4. Sinh keys
php artisan key:generate
php artisan jwt:secret

# 5. Chạy migration + seeder
php artisan migrate --seed

# 6. Link storage
php artisan storage:link

# 7. Cài frontend dependencies
npm install
npm run dev        # Development
# npm run build    # Production

# 8. Chạy server
php artisan serve  # http://localhost:8000
```

---

## 4. Chi Tiết Xác Thực JWT

### 4.1 Config quan trọng (`config/jwt.php` + `.env`)

| Biến                        | Giá trị mặc định | Ý nghĩa                                                 |
|-----------------------------|-------------------|----------------------------------------------------------|
| `JWT_SECRET`                | *(phải sinh)*     | Khoá bí mật ký token (chạy `php artisan jwt:secret`)    |
| `JWT_TTL`                   | `60`              | Access token hết hạn sau 60 phút                         |
| `JWT_REFRESH_TTL`           | `20160`           | Thời gian cho phép refresh (14 ngày = 20160 phút)        |
| `JWT_BLACKLIST_ENABLED`     | `true`            | Bật blacklist để vô hiệu hoá token cũ khi refresh/logout |
| `JWT_BLACKLIST_GRACE_PERIOD`| `30`              | 30 giây grace period cho concurrent requests              |

### 4.2 Cơ chế xoay vòng token

1. **Login** → Server tạo access_token (JWT) với TTL = 60 phút
2. **Sử dụng** → Client gửi `Authorization: Bearer {token}` trong mọi request
3. **Gần hết hạn** → Client gọi `POST /api/auth/refresh` với token cũ
4. **Refresh** → Server:
   - Kiểm tra token cũ còn trong `refresh_ttl` (14 ngày)
   - Đưa token cũ vào **blacklist** (Redis)
   - Phát hành token mới
5. **Logout** → Token bị đưa vào blacklist, không thể dùng lại

### 4.3 Các file liên quan

| File | Vai trò |
|------|---------|
| `config/jwt.php` | Cấu hình JWT: TTL, thuật toán, blacklist |
| `config/auth.php` | Guard `api` sử dụng driver `jwt` |
| `app/Models/User.php` | Implements `JWTSubject` → custom claims (`role_id`, `email`) |
| `app/Http/Controllers/AuthController.php` | Login, register, refresh, logout, me |
| `app/Http/Middleware/JwtAuthenticate.php` | Xác thực JWT token trên mọi request |
| `app/Http/Middleware/JwtAdminMiddleware.php` | Kiểm tra quyền admin sau khi xác thực JWT |
| `routes/api.php` | Định nghĩa các route API |
| `bootstrap/app.php` | Đăng ký middleware alias + API routing |

---

## 5. Redis — Cache Phiên & Blacklist Token

### 5.1 Redis được dùng cho 3 mục đích

| Mục đích | Redis DB | Key pattern | TTL |
|----------|----------|-------------|-----|
| **JWT Blacklist** | DB 0 | `laravel-database-{jti}` | = `refresh_ttl` |
| **Cache phiên user** | DB 1 | `laravel-cache-user_session:{user_id}` | = `jwt.ttl` × 60s |
| **Session Laravel** | DB 0 | `laravel-database-{session_id}` | = `session.lifetime` |

### 5.2 Cách hoạt động cache phiên

```
// Login: cache user + role vào Redis
Cache::store('redis')->put("user_session:{$user->id}", $user->load('role')->toArray(), 3600);

// Đọc user (ưu tiên Redis, fallback DB):
$cached = Cache::store('redis')->get("user_session:{$user->id}");

// Logout: xoá cache
Cache::store('redis')->forget("user_session:{$user->id}");
```

**Lợi ích:**
- Endpoint `GET /api/auth/me` đọc từ Redis → **không query DB**
- Giảm tải DB trên các trang traffic cao (dashboard, API mobile)
- TTL tự động hết hạn khớp với vòng đời token

### 5.3 Kiểm tra Redis

```powershell
# Kết nối Redis CLI
redis-cli                              # Local
docker compose exec redis redis-cli    # Docker

# Xem tất cả keys
KEYS *

# Xem cache phiên user
GET "laravel-cache-user_session:1"

# Xem số keys
DBSIZE

# Monitor realtime
MONITOR
```

---

## 6. API Endpoints

### 6.1 Authentication

| Method | URI | Middleware | Mô tả |
|--------|-----|-----------|--------|
| `POST` | `/api/auth/register` | — | Đăng ký tài khoản |
| `POST` | `/api/auth/login` | — | Đăng nhập, nhận access_token |
| `POST` | `/api/auth/refresh` | `jwt.auth` | Xoay vòng token (rotate) |
| `POST` | `/api/auth/logout` | `jwt.auth` | Đăng xuất, blacklist token |
| `GET`  | `/api/auth/me` | `jwt.auth` | Thông tin user (từ Redis cache) |

### 6.2 Request / Response mẫu

#### Đăng ký

```http
POST /api/auth/register
Content-Type: application/json

{
  "name": "Nguyễn Văn A",
  "email": "nguyenvana@example.com",
  "phone": "0901234567",
  "password": "matkhau123",
  "password_confirmation": "matkhau123"
}
```

Response `201`:
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "bearer",
  "expires_in": 3600,
  "user": {
    "id": 1,
    "name": "Nguyễn Văn A",
    "email": "nguyenvana@example.com"
  }
}
```

#### Đăng nhập

```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "nguyenvana@example.com",
  "password": "matkhau123"
}
```

Response `200`:
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "bearer",
  "expires_in": 3600,
  "user": { "id": 1, "name": "Nguyễn Văn A", ... }
}
```

#### Refresh token

```http
POST /api/auth/refresh
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

Response `200`: Trả về token mới, token cũ bị blacklist.

#### Xem profile

```http
GET /api/auth/me
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

#### Đăng xuất

```http
POST /api/auth/logout
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
```

### 6.3 Mã lỗi

| HTTP Code | Error Key | Ý nghĩa |
|-----------|-----------|----------|
| `401` | `token_expired` | Token hết hạn → gọi `/refresh` |
| `401` | `token_invalid` | Token không hợp lệ / bị blacklist |
| `401` | `token_absent` | Không có header Authorization |
| `403` | `forbidden` | Không có quyền (ví dụ: không phải admin) |
| `404` | `user_not_found` | User không tồn tại |
| `422` | `errors` | Validation thất bại |

---

## 7. Luồng Xác Thực Client-Side

### JavaScript/Axios Example

```javascript
// ── Login ──
const login = async (email, password) => {
  const { data } = await axios.post('/api/auth/login', { email, password });
  localStorage.setItem('access_token', data.access_token);
  localStorage.setItem('token_expires_at', Date.now() + data.expires_in * 1000);
  return data.user;
};

// ── Axios interceptor — tự động gắn token ──
axios.interceptors.request.use(config => {
  const token = localStorage.getItem('access_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// ── Axios interceptor — tự động refresh khi 401 ──
axios.interceptors.response.use(
  response => response,
  async error => {
    const originalRequest = error.config;
    if (error.response?.status === 401
        && error.response?.data?.error === 'token_expired'
        && !originalRequest._retry) {
      originalRequest._retry = true;
      try {
        const { data } = await axios.post('/api/auth/refresh');
        localStorage.setItem('access_token', data.access_token);
        originalRequest.headers.Authorization = `Bearer ${data.access_token}`;
        return axios(originalRequest);
      } catch (refreshError) {
        // Refresh cũng thất bại → bắt user login lại
        localStorage.removeItem('access_token');
        window.location.href = '/account/login';
      }
    }
    return Promise.reject(error);
  }
);

// ── Logout ──
const logout = async () => {
  await axios.post('/api/auth/logout');
  localStorage.removeItem('access_token');
  window.location.href = '/';
};
```

---

## 8. Cấu Trúc File Đã Thay Đổi / Thêm Mới

```
📁 Đã thay đổi:
├── app/Http/Controllers/AuthController.php    ← Thêm register, me, Redis cache
├── bootstrap/app.php                          ← Thêm API routes + JWT middleware alias
├── .env.example                               ← Session/Cache → Redis, thêm JWT vars
├── config/database.php                        ← Redis client → predis

📁 Thêm mới:
├── app/Http/Middleware/JwtAuthenticate.php     ← Middleware xác thực JWT
├── app/Http/Middleware/JwtAdminMiddleware.php  ← Middleware phân quyền admin (JWT)
├── routes/api.php                             ← API routes
├── .env.docker                                ← Env mẫu cho Docker
├── .dockerignore                              ← Ignore list cho Docker build
├── docker-compose.yml                         ← Docker Compose (Nginx + PHP + MySQL + Redis + Node)
├── docker/
│   ├── Dockerfile                             ← PHP 8.2-FPM image
│   ├── nginx/default.conf                     ← Nginx config
│   └── php/local.ini                          ← PHP config overrides

📁 Đã có sẵn (không cần thay đổi):
├── config/jwt.php                             ← ✅ Cấu hình JWT đầy đủ
├── config/auth.php                            ← ✅ Guard api → jwt
├── app/Models/User.php                        ← ✅ Implements JWTSubject
├── composer.json                              ← ✅ tymon/jwt-auth + predis
```

---

## 9. Xử Lý Lỗi Thường Gặp

### ❌ `JWT_SECRET` chưa được sinh

```
Tymon\JWTAuth\Exceptions\JWTException: Secret is not defined
```

**Giải pháp:** `php artisan jwt:secret`

### ❌ Redis connection refused

```
Predis\Connection\ConnectionException: Connection refused [tcp://127.0.0.1:6379]
```

**Giải pháp:**
- Kiểm tra Redis đang chạy: `redis-cli ping` → `PONG`
- Docker: kiểm tra `REDIS_HOST=redis` (tên service, không phải `127.0.0.1`)

### ❌ Token expired vs Token invalid

- `token_expired` → Token hết hạn nhưng còn trong `refresh_ttl` → Gọi `/api/auth/refresh`
- `token_invalid` → Token đã bị blacklist hoặc bị thay đổi → Phải login lại

### ❌ CSRF token mismatch trên API routes

Đã được xử lý: `bootstrap/app.php` loại trừ `api/*` khỏi CSRF verification.

### ❌ Docker: MySQL connection refused lúc khởi động

Container `app` có `depends_on` với `condition: service_healthy`. MySQL cần ~15-30s để sẵn sàng. Nếu vẫn lỗi:

```powershell
docker compose restart app
```

---

> **Lưu ý bảo mật:**
> - Không commit file `.env` lên Git
> - `JWT_SECRET` phải được giữ bí mật, đổi ngay nếu bị lộ: `php artisan jwt:secret --force`
> - Trong production: `APP_DEBUG=false`, dùng HTTPS, cấu hình `SESSION_SECURE_COOKIE=true`
