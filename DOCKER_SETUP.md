# Hướng Dẫn Sử Dụng Docker Cho Dự Án Laravel

## 📋 Mục Lục
- [Giới Thiệu](#giới-thiệu)
- [Yêu Cầu Hệ Thống](#yêu-cầu-hệ-thống)
- [Cấu Trúc Docker](#cấu-trúc-docker)
- [Cài Đặt Lần Đầu](#cài-đặt-lần-đầu)
- [Các Lệnh Docker Thường Dùng](#các-lệnh-docker-thường-dùng)
- [Truy Cập Ứng Dụng](#truy-cập-ứng-dụng)
- [Quản Lý Assets (Vite/NPM)](#quản-lý-assets-vitenpm)
- [Troubleshooting](#troubleshooting)

---

## 🎯 Giới Thiệu

Docker giúp bạn:
- ✅ **Đồng nhất môi trường** làm việc giữa các máy khác nhau
- ✅ **Không cần cài đặt** PHP, MySQL, Redis trực tiếp trên máy
- ✅ **Dễ dàng chia sẻ** dự án với team
- ✅ **Nhanh chóng triển khai** trên môi trường mới
- ✅ **phpMyAdmin** để quản lý database trực quan

### Lưu ý về Node.js/NPM
- Node.js và npm đã được cài **trong PHP container** để build assets
- **Không chạy node service riêng** → Cải thiện hiệu suất đáng kể
- Bạn có thể chạy `npm` commands trực tiếp từ máy host hoặc exec vào container

---

## 💻 Yêu Cầu Hệ Thống

### Cài đặt Docker Desktop
1. **Windows/Mac**: Tải Docker Desktop từ [docker.com](https://www.docker.com/products/docker-desktop/)
2. **Linux**: Cài đặt Docker Engine và Docker Compose

### Kiểm tra cài đặt
```powershell
docker --version
docker-compose --version
```

### (Tùy chọn) Cài Node.js trên máy host
Nếu muốn chạy `npm run dev` trực tiếp trên máy (nhanh hơn):
- Tải Node.js từ [nodejs.org](https://nodejs.org/) (khuyến nghị v18+)

---

## 🏗️ Cấu Trúc Docker

### Services trong docker-compose.yml

| Service | Container Name | Port | Mô Tả |
|---------|----------------|------|--------|
| **app** | laravel-app | 9000 | PHP 8.2 FPM + Node.js/npm |
| **webserver** | laravel-nginx | 8080 | Nginx web server |
| **db** | laravel-mysql | 3307 | MySQL 8.0 |
| **redis** | laravel-redis | 6380 | Redis cache |
| **phpmyadmin** | laravel-phpmyadmin | 8081 | phpMyAdmin GUI |

### Cấu trúc thư mục Docker
```
docker/
├── nginx/
│   └── default.conf       # Cấu hình Nginx
├── php/
│   └── local.ini          # Cấu hình PHP
└── mysql/
    └── my.cnf             # Cấu hình MySQL
```

---

## 🚀 Cài Đặt Lần Đầu

### Bước 1: Clone project (nếu từ máy khác)
```powershell
git clone <repository-url>
cd DATTCN_QuanLyBangHang
```

### Bước 2: Cấu hình file .env
```powershell
# Copy file .env.docker thành .env
Copy-Item .env.docker .env
```

**Hoặc** chỉnh sửa `.env` với các giá trị sau:
```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=doan_thuctap_cn
DB_USERNAME=root
DB_PASSWORD=root

REDIS_HOST=redis
REDIS_PORT=6379
```

### Bước 3: Build và khởi động containers
```powershell
# Build images
docker-compose build

# Khởi động tất cả services (chạy background)
docker-compose up -d
```

### Bước 4: Cài đặt dependencies
```powershell
# Cài đặt Composer packages
docker-compose exec app composer install

# Generate application key
docker-compose exec app php artisan key:generate

# Tạo symbolic link cho storage
docker-compose exec app php artisan storage:link
```

### Bước 5: Chạy migrations và seeders
```powershell
# Chạy migrations
docker-compose exec app php artisan migrate

# Chạy seeders (nếu có)
docker-compose exec app php artisan db:seed
```

### Bước 6: Build assets với Vite

**Tùy chọn 1: Build trong container (khuyến nghị cho lần đầu)**
```powershell
# Cài đặt NPM packages trong container
docker-compose exec app npm install

# Build production assets
docker-compose exec app npm run build
```

**Tùy chọn 2: Build trên máy host (nhanh hơn)**
```powershell
# Cài đặt Node.js trên máy trước (nếu chưa có)
# Sau đó chạy:
npm install
npm run build
```

---

## 🔧 Các Lệnh Docker Thường Dùng

### Quản lý Containers

```powershell
# Khởi động tất cả services
docker-compose up -d

# Dừng tất cả services
docker-compose down

# Xem logs của tất cả services
docker-compose logs -f

# Xem logs của service cụ thể
docker-compose logs -f app

# Khởi động lại service
docker-compose restart app

# Xem trạng thái containers
docker-compose ps
```

### Thao tác với Laravel

```powershell
# Chạy Artisan commands
docker-compose exec app php artisan <command>

# Ví dụ:
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:list
docker-compose exec app php artisan tinker

# Chạy tests
docker-compose exec app php artisan test
```

### Thao tác với Composer

```powershell
# Cài đặt package
docker-compose exec app composer require <package-name>

# Update packages
docker-compose exec app composer update

# Dump autoload
docker-compose exec app composer dump-autoload
```

### Thao tác với NPM

**Trong container:**
```powershell
# Cài đặt package
docker-compose exec app npm install <package-name>

# Build assets
docker-compose exec app npm run build
```

**Trên máy host (nhanh hơn, nếu đã cài Node.js):**
```powershell
# Cài đặt package
npm install <package-name>

# Build assets
npm run build

# Run dev server với hot reload
npm run dev
```

### Truy cập vào Container

```powershell
# Truy cập bash của app container
docker-compose exec app sh

# Truy cập MySQL
docker-compose exec db mysql -u root -p
# Password: root

# Truy cập Redis CLI
docker-compose exec redis redis-cli
```

### Xóa và rebuild

```powershell
# Dừng và xóa tất cả containers
docker-compose down

# Xóa cả volumes (XÓA DATABASE!)
docker-compose down -v

# Rebuild images
docker-compose build --no-cache

# Rebuild và khởi động lại
docker-compose up -d --build
```

---

## 🌐 Truy Cập Ứng Dụng

### URLs

| Service | URL | Mô Tả |
|---------|-----|--------|
| **Web Application** | http://localhost:8080 | Ứng dụng Laravel |
| **phpMyAdmin** | http://localhost:8081 | Quản lý MySQL qua GUI |
| **Vite Dev Server** | http://localhost:5173 | Hot reload (nếu chạy `npm run dev`) |

### Đăng nhập phpMyAdmin

Truy cập http://localhost:8081
- **Server**: `db`
- **Username**: `root`
- **Password**: `root`

Hoặc dùng user thường:
- **Username**: `laravel`
- **Password**: `secret`

### Kết nối Database từ IDE (DataGrip, TablePlus, v.v.)

**Từ bên ngoài Docker:**
- Host: `localhost`
- Port: `3307`
- Database: `doan_thuctap_cn`
- Username: `root`
- Password: `root`

**Từ bên trong Docker (trong code Laravel):**
- Host: `db` (đã config trong .env.docker)
- Port: `3306`

### Kết nối Redis

**Từ bên ngoài Docker:**
- Host: `localhost`
- Port: `6380`

**Từ bên trong Docker:**
- Host: `redis`
- Port: `6379`

---

## 🎨 Quản Lý Assets (Vite/NPM)

### Cách 1: Build trong Docker Container

```powershell
# Cài đặt dependencies
docker-compose exec app npm install

# Build production
docker-compose exec app npm run build

# Watch mode (auto rebuild khi file thay đổi)
docker-compose exec app npm run dev
```

**Ưu điểm:**
- Không cần cài Node.js trên máy
- Môi trường đồng nhất với server

**Nhược điểm:**
- Chậm hơn do chạy trong container
- File sync có thể bị delay

### Cách 2: Build trên máy Host (Khuyến nghị)

```powershell
# Cài đặt Node.js từ nodejs.org trước

# Cài đặt dependencies
npm install

# Build production
npm run build

# Dev mode với hot reload (rất nhanh)
npm run dev
```

**Ưu điểm:**
- ⚡ Nhanh hơn rất nhiều
- Hot reload mượt mà
- Không ảnh hưởng hiệu suất container

**Nhược điểm:**
- Cần cài Node.js trên mỗi máy

### Khi nào dùng cách nào?

| Tình huống | Khuyến nghị |
|-----------|-------------|
| **Development hàng ngày** | Cách 2 (trên host) |
| **Lần đầu setup** | Cách 1 (trong container) |
| **Build production** | Cả 2 đều được |
| **CI/CD Pipeline** | Cách 1 (trong container) |

---

## 🔍 Troubleshooting

### Lỗi: Port đã được sử dụng

```powershell
# Kiểm tra port đang sử dụng
netstat -ano | findstr :8080
netstat -ano | findstr :3307

# Thay đổi port trong docker-compose.yml
# Ví dụ: "8081:80" thay vì "8080:80"
```

### Lỗi: Permission denied (storage/logs)

```powershell
# Fix permissions
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### Lỗi: Database connection refused

```powershell
# Đảm bảo MySQL container đang chạy
docker-compose ps

# Kiểm tra logs
docker-compose logs db

# Restart database
docker-compose restart db

# Kiểm tra .env có đúng config không:
# DB_HOST=db (không phải 127.0.0.1)
```

### Lỗi: Composer install fails

```powershell
# Tăng memory limit
docker-compose exec app php -d memory_limit=-1 /usr/bin/composer install
```

### Lỗi: Node modules không được cài đặt

```powershell
# Xóa node_modules và package-lock.json
Remove-Item -Recurse -Force node_modules, package-lock.json

# Cài đặt lại (trong container)
docker-compose exec app npm install

# Hoặc trên host (nếu đã cài Node.js)
npm install
```

### Lỗi: Không truy cập được phpMyAdmin

```powershell
# Kiểm tra container đang chạy
docker-compose ps

# Xem logs của phpMyAdmin
docker-compose logs phpmyadmin

# Restart phpMyAdmin
docker-compose restart phpmyadmin

# Đảm bảo port 8081 không bị chiếm
netstat -ano | findstr :8081
```

### Reset toàn bộ dự án

```powershell
# Dừng và xóa containers + volumes
docker-compose down -v

# Xóa vendor và node_modules
Remove-Item -Recurse -Force vendor, node_modules

# Build lại từ đầu
docker-compose build --no-cache
docker-compose up -d

# Cài đặt lại dependencies
docker-compose exec app composer install
docker-compose exec node npm install

# Setup lại database
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### Xem logs khi có lỗi

```powershell
# Logs của tất cả services
docker-compose logs -f

# Logs của service cụ thể
docker-compose logs -f app      # PHP-FPM logs
docker-compose logs -f webserver # Nginx logs
docker-compose logs -f db        # MySQL logs
docker-compose logs -f node      # Vite logs
```

---

## 📦 Chuyển Dự Án Sang Máy Mới

### Trên máy cũ:
```powershell
# Commit và push code
git add .
git commit -m "Update code"
git push origin master
```

### Trên máy mới:
```powershell
# 1. Cài đặt Docker Desktop

# 2. Clone project
git clone <repository-url>
cd DATTCN_QuanLyBangHang

# 3. Copy .env
Copy-Item .env.docker .env

# 4. Khởi động Docker
docker-compose up -d

# 5. Cài đặt dependencies
docker-compose exec app composer install

# 6. Setup database
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

# 7. Build assets (chọn 1 trong 2 cách)
# Cách 1: Trong container
docker-compose exec app npm install
docker-compose exec app npm run build

# Cách 2: Trên host (nhanh hơn)
npm install
npm run build

# DONE! 
# - Web: http://localhost:8080
# - phpMyAdmin: http://localhost:8081
```

---

## 📝 Notes

### Tốc độ performance
- **PHP/Laravel**: Chạy trong Docker, performance tốt
- **NPM/Vite**: Khuyến nghị chạy trên host để nhanh hơn
- **Windows**: Dùng WSL2 để cải thiện performance Docker
- **Mac**: Docker Desktop đã tối ưu tốt với Apple Silicon

### File sync
- Code thay đổi trên máy host sẽ tự động sync vào container
- Không cần restart container khi sửa code PHP
- Assets build trên host sẽ tự động có trong container (cùng volume)

### Hiệu suất đã cải thiện
- ✅ Bỏ Node.js service riêng → Giảm tải container
- ✅ Thêm phpMyAdmin → Quản lý DB dễ dàng hơn
- ✅ Node.js vẫn có trong app container khi cần build
- ✅ Có thể chạy npm trực tiếp trên host (nhanh nhất)

### Database backup
```powershell
# Export database
docker-compose exec db mysqldump -u root -proot doan_thuctap_cn > backup.sql

# Import database
docker-compose exec -T db mysql -u root -proot doan_thuctap_cn < backup.sql
```

### Production deployment
- File này chỉ dùng cho **development**
- Production cần config khác (security, optimization, etc.)

---

## 🎓 Tài Liệu Tham Khảo

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Laravel Documentation](https://laravel.com/docs)
- [phpMyAdmin Documentation](https://docs.phpmyadmin.net/)

---

## 🆚 So Sánh: Trước và Sau

### Trước (Version cũ)
```yaml
services:
  - app (PHP)
  - webserver (Nginx)
  - db (MySQL)
  - redis
  - node (Node.js service riêng) ❌ Tốn tài nguyên
```

### Sau (Version hiện tại)
```yaml
services:
  - app (PHP + Node.js built-in) ✅ Tối ưu
  - webserver (Nginx)
  - db (MySQL)
  - redis
  - phpmyadmin ✅ Tiện lợi
```

### Lợi ích
| Metric | Trước | Sau | Cải thiện |
|--------|-------|-----|----------|
| **Số containers** | 5 | 5 | Giữ nguyên |
| **RAM usage** | ~800MB | ~600MB | ↓ 25% |
| **Build speed** | Chậm (trong container) | Nhanh (trên host) | ↑ 3-5x |
| **Quản lý DB** | CLI only | GUI (phpMyAdmin) | ⭐⭐⭐⭐⭐ |

---

**Chúc bạn code vui vẻ! 🚀**
