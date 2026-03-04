<p align="right">
  <a href="README_VI.md">🇻🇳 Tiếng Việt</a> | <a href="README.md">🇬🇧 English</a>
</p>

# 🛒 Hệ Thống Quản Lý Bán Hàng & Website Bán Sản Phẩm Công Nghệ

> Full-stack e-commerce platform xây dựng bằng **Laravel 12**, bao gồm website mua sắm cho khách hàng và trang quản trị cho admin. Tích hợp thanh toán tự động qua **SePay Webhook** và cập nhật đơn hàng real-time qua **WebSocket (Pusher)**.

<table>
  <tr>
    <td>🌐 <strong>Website Demo</strong></td>
    <td><a href="https://ecom.duyhung.io.vn" target="_blank">ecom.duyhung.io.vn</a></td>
  </tr>
  <tr>
    <td>👤 <strong>Tài khoản Demo</strong></td>
    <td><code>duyhung@gmail.com</code> / <code>duyhung456</code></td>
  </tr>
</table>

---

## 📋 Mục Lục

- [Tổng Quan](#-tổng-quan)
- [Tính Năng](#-tính-năng)
- [Công Nghệ Sử Dụng](#-công-nghệ-sử-dụng)
- [Kiến Trúc Hệ Thống](#-kiến-trúc-hệ-thống)
- [Cơ Sở Dữ Liệu](#-cơ-sở-dữ-liệu)
- [Cài Đặt & Chạy Dự Án](#-cài-đặt--chạy-dự-án)
- [Cấu Trúc Thư Mục](#-cấu-trúc-thư-mục)
- [Screenshots](#-screenshots)
- [Hướng Phát Triển](#-hướng-phát-triển)

---

## 🎯 Tổng Quan

Dự án xây dựng một hệ thống bán hàng trực tuyến chuyên về **sản phẩm công nghệ** (Laptop, PC, RAM, linh kiện...), gồm 2 phần chính:

| Phần | Mô tả |
|------|--------|
| **Client (Khách hàng)** | Duyệt sản phẩm, xem chi tiết, giỏ hàng, checkout, theo dõi đơn hàng |
| **Admin (Quản trị)** | Dashboard thống kê, CRUD sản phẩm/danh mục/thương hiệu, quản lý đơn hàng, tồn kho, khuyến mãi, tài khoản |

---

## ✨ Tính Năng

### Phía Khách Hàng
- 🏠 Trang chủ hiển thị sản phẩm theo danh mục (Laptop, PC, RAM...)
- 🔍 Tìm kiếm sản phẩm
- 🏷️ Duyệt sản phẩm theo **slug** thông minh (tự nhận diện danh mục / thương hiệu / sản phẩm)
- 📦 Xem chi tiết sản phẩm với ảnh gallery & thông số kỹ thuật
- 🛒 Giỏ hàng hỗ trợ cả **khách vãng lai (session)** và **người dùng đăng nhập (database)**
- 💳 Checkout với nhập thông tin giao hàng đầy đủ (tỉnh/huyện/xã)
- 🎫 Áp mã khuyến mãi (% hoặc số tiền cố định) với kiểm tra hiệu lực
- 💰 Thanh toán COD hoặc chuyển khoản ngân hàng tự động qua **SePay**
- 📡 Cập nhật trạng thái đơn hàng **real-time** qua WebSocket khi thanh toán thành công
- 📋 Tra cứu lịch sử đơn hàng

### Phía Quản Trị (Admin)
- 📊 **Dashboard** thống kê: tổng đơn hàng, doanh thu, khách hàng, biểu đồ doanh thu theo tháng
- 📁 Quản lý **danh mục** sản phẩm (CRUD, bật/tắt trạng thái)
- 🏢 Quản lý **thương hiệu** theo danh mục
- 📱 Quản lý **sản phẩm**: thông tin, ảnh đại diện, gallery ảnh, thuộc tính kỹ thuật (key-value)
- 📦 Quản lý **tồn kho**: cảnh báo sản phẩm sắp hết hàng
- 🧾 Quản lý **đơn hàng**: xem chi tiết, cập nhật trạng thái theo luồng hợp lệ (`pending → delivery → completed`)
- 🎁 Quản lý **khuyến mãi**: tạo mã giảm giá, giới hạn thời gian & lượt sử dụng
- 👥 Quản lý **tài khoản** người dùng & phân quyền
- 🔧 Quản lý **menu** động & cài đặt hệ thống

### Tích Hợp & Kỹ Thuật
- 🔐 **Xác thực JWT** (xạy vòng access + refresh token) cho các API endpoint
- 🔐 Xác thực & phân quyền Session-based cho web routes (Laravel Auth + Admin Middleware)
- 🪝 Webhook thanh toán tự động (**SePay**): nhận giao dịch → tách mã đơn → xác nhận thanh toán
- 📡 Real-time broadcasting (**Pusher**): thông báo cập nhật trạng thái đơn hàng
- 🐳 **Docker** container hoá môi trường phát triển (Nginx + PHP-FPM + MySQL + Redis + Node)
- ⚡ Caching danh mục sidebar giảm truy vấn DB
- 🖼️ Upload & quản lý ảnh sản phẩm (Storage)

---

## 🛠 Công Nghệ Sử Dụng

### Backend
| Công nghệ | Phiên bản | Vai trò |
|-----------|-----------|---------|
| **PHP** | 8.2+ | Ngôn ngữ lập trình |
| **Laravel** | 12.x | Framework MVC chính |
| **Eloquent ORM** | - | Tương tác database || **JWT Auth** (`tymon/jwt-auth`) | 2.2 | Xác thực API với xoay vòng token || **Laravel UI** | 4.6 | Scaffold Authentication |
| **SePay Laravel** | 1.2 | Tích hợp thanh toán |
| **Pusher** | 7.2 | WebSocket real-time |

### Frontend
| Công nghệ | Vai trò |
|-----------|---------|
| **Blade Template** | Server-side rendering |
| **AdminLTE 4** | Giao diện trang quản trị |
| **Bootstrap 5** | UI framework responsive |
| **Bootstrap Icons** | Icon set |
| **Vite** | Build tool & HMR |
| **Laravel Echo + Pusher JS** | Real-time client |
| **AJAX / Axios** | Tương tác bất đồng bộ |

### Database & Infra
| Công nghệ | Vai trò |
|-----------|---------|
| **MySQL / MariaDB** | Hệ quản trị CSDL || **Redis** | JWT blacklist, session & cache (sẵn sàng kích hoạt) |
| **Docker + Docker Compose** | Container hoá môi trường dev |
| **Nginx** | Reverse proxy (Docker) || **Laravel Migrations** | Quản lý schema |
| **Laravel Seeder / Factory** | Dữ liệu mẫu |

---

## 🏗 Kiến Trúc Hệ Thống

```
┌─────────────────────────────────────────────────────────┐
│                      CLIENT (Browser)                   │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │  Trang chủ   │  │  Giỏ hàng    │  │   Checkout    │  │
│  │  Sản phẩm    │  │  (AJAX)      │  │   Đặt hàng   │  │
│  └──────────────┘  └──────────────┘  └───────────────┘  │
│                         │                                │
│              Laravel Echo + Pusher JS                    │
│              (Real-time order status)                    │
└────────────────────────┬────────────────────────────────┘
                         │ HTTP / WebSocket
┌────────────────────────┼────────────────────────────────┐
│                   LARAVEL 12 (Backend)                   │
│  ┌─────────┐  ┌───────────────┐  ┌───────────────────┐  │
│  │ Routes  │→ │  Controllers  │→ │     Models        │  │
│  │ web.php │  │  admin/ + client/│ │  (Eloquent ORM)  │  │
│  └─────────┘  └───────────────┘  └───────────────────┘  │
│  ┌─────────┐  ┌───────────────┐  ┌───────────────────┐  │
│  │Middleware│  │    Events     │  │    Listeners      │  │
│  │ (Auth,  │  │ OrderStatus   │  │  SePayWebhook     │  │
│  │  Admin) │  │   Updated     │  │   Listener        │  │
│  └─────────┘  └───────────────┘  └───────────────────┘  │
└────────────────────────┬────────────────────────────────┘
              ┌──────────┼──────────┐
              ▼          ▼          ▼
        ┌──────────┐ ┌────────┐ ┌────────┐
        │  MySQL   │ │ Pusher │ │  SePay │
        │ Database │ │  (WS)  │ │Webhook │
        └──────────┘ └────────┘ └────────┘
              ▲
              │ (tuỳ chọn)
        ┌──────────┐
        │  Redis   │
        │(Cache/BL)│
        └──────────┘
```

### Luồng Xác Thực JWT

```
Client                            Server
  │── POST /api/auth/login ─────▸ │ Xác thực credentials → Phát hành JWT
  │◂── { access_token (60min) } ──│
  │                                │
  │── GET /api/... ──────────────▸ │ Validate JWT → Xử lý request
  │   Authorization: Bearer {jwt}  │
  │                                │
  │── POST /api/auth/refresh ───▸  │ Blacklist token cũ → Phát hành JWT mới
  │◂── { new access_token } ──────│
  │                                │
  │── POST /api/auth/logout ────▸  │ Blacklist token
  │◂── { thành công } ─────────────│
```

---

## 🗄 Cơ Sở Dữ Liệu

### Sơ đồ quan hệ (ERD)

```
roles ──────────< users
                    │
categories ────< brands     users ──────< orders
    │               │                      │  │
    └───────< products ──< order_items >───┘  │
                │  │  │                        │
                │  │  └──< product_images   promotions
                │  └─────< product_attributes
                │
                └────── inventory
                
users ──────< carts ──< cart_items >── products
```

### Các bảng chính

| Bảng | Mô tả |
|------|--------|
| `users` | Người dùng (khách hàng & admin) |
| `roles` | Vai trò (customer, admin) |
| `categories` | Danh mục sản phẩm |
| `brands` | Thương hiệu theo danh mục |
| `products` | Sản phẩm (SKU, giá, mô tả, slug...) |
| `product_images` | Gallery ảnh sản phẩm |
| `product_attributes` | Thông số kỹ thuật (key-value) |
| `inventory` | Tồn kho & cảnh báo hết hàng |
| `carts` / `cart_items` | Giỏ hàng cho user đăng nhập |
| `orders` / `order_items` | Đơn hàng & chi tiết đơn |
| `promotions` | Mã khuyến mãi giảm giá |

---

## 🚀 Cài Đặt & Chạy Dự Án

### Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL / MariaDB
- Git
- **Docker Desktop** (tuỳ chọn — khuyến nghị để đồng nhất môi trường)

### Cách A: Cài đặt nhanh với Docker 🐳
<details>
 <summary><strong>Nhấn vào đây để xem đầy đủ cách A</strong></summary>
```bash
# 1. Clone & cấu hình
git clone <repository-url>
cd DATTCN_QuanLyBangHang
cp .env.docker .env              # Dùng env mẫu cho Docker

# 2. Khởi chạy containers
docker compose up -d --build

# 3. Setup Laravel trong container
docker compose exec app bash
composer install
php artisan key:generate
php artisan jwt:secret           # Sinh JWT signing key
php artisan migrate --seed
php artisan storage:link
exit

# 4. Truy cập
# Web:  http://localhost:8080
# API:  http://localhost:8080/api/auth/login
```
<details>
### Cách B: Cài đặt thủ công
<details>
 <summary><strong>Nhấn vào đây để xem đầy đủ cách B</strong></summary>
```bash
# 1. Clone repository
git clone <repository-url>
cd DATTCN_QuanLyBangHang

# 2. Cài đặt dependencies
composer install
npm install

# 3. Cấu hình môi trường
cp .env.example .env
php artisan key:generate
php artisan jwt:secret           # Sinh JWT signing key

# 4. Cấu hình database trong file .env
# DB_DATABASE=your_database
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# 5. Cấu hình Pusher (real-time) trong .env
# PUSHER_APP_ID=...
# PUSHER_APP_KEY=...
# PUSHER_APP_SECRET=...
# PUSHER_APP_CLUSTER=...

# 6. Cấu hình SePay (thanh toán) trong .env
# SEPAY_API_TOKEN=...

# 7. Chạy migration & seeder
php artisan migrate
php artisan db:seed

# 8. Link storage
php artisan storage:link

# 9. Build frontend assets
npm run build
```

### Chạy dự án (Development)

```bash
# Chạy tất cả services cùng lúc (server + queue + logs + vite)
composer dev
```

Hoặc chạy riêng từng service:

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite dev server (HMR)
npm run dev

# Terminal 3 - Queue worker (xử lý webhook)
php artisan queue:listen
```

Truy cập: `http://localhost:8000`
<details>
---

## 📂 Cấu Trúc Thư Mục

```
app/
├── Events/                 # Event broadcasting (OrderStatusUpdated)
├── Helpers/                # Helper functions
├── Http/
│   ├── Controllers/
│   │   ├── admin/          # 11 controllers quản trị
│   │   │   ├── CategoryController      # CRUD danh mục
│   │   │   ├── BrandController         # CRUD thương hiệu
│   │   │   ├── ProductController       # CRUD sản phẩm + ảnh + thuộc tính
│   │   │   ├── OrderController         # Quản lý đơn hàng
│   │   │   ├── InventoryController     # Quản lý tồn kho
│   │   │   ├── PromotionController     # Quản lý khuyến mãi
│   │   │   ├── AccountController       # Quản lý tài khoản
│   │   │   ├── MenuController          # Quản lý menu
│   │   │   └── SettingController       # Cài đặt hệ thống
│   │   ├── client/         # 7 controllers phía khách hàng
│   │   │   ├── ProductController       # Xem sản phẩm & slug routing
│   │   │   ├── CartController          # Giỏ hàng (session + DB)
│   │   │   ├── OrderController         # Checkout & đặt hàng
│   │   │   └── SearchController        # Tìm kiếm sản phẩm
│   │   └── HomeController.php          # Trang chủ + Dashboard
│   └── Middleware/         # Auth, Admin middleware
├── Listeners/              # SePayWebhookListener (xử lý thanh toán)
├── Models/                 # 14 Eloquent models
├── Observers/              # InventoryObserver
└── Providers/              # AppServiceProvider, ViewServiceProvider (cache)

resources/views/
├── admin/                  # Blade views quản trị (AdminLTE)
│   ├── dashboard.blade.php
│   ├── category/, brand/, product/, order/
│   ├── inventory/, promotion/, account/
│   └── setting/, menu/
├── client/                 # Blade views khách hàng
│   ├── home.blade.php
│   ├── product.blade.php, showbyslug.blade.php
│   ├── cart.blade.php, checkout.blade.php
│   ├── order_success.blade.php, topup.blade.php
│   └── ordersHistory.blade.php
├── layouts/                # Layout chung
└── auth/                   # Đăng nhập / Đăng ký

database/migrations/        # 16 migration files
database/seeders/           # Dữ liệu mẫu
```

---

## 📸 Screenshots
<details>
 <summary><strong>Nhấn vào đây để xem full hình ảnh</strong></summary>
**CLIEN** 
![Home Page](docs/image.png)
![List product](docs/image-1.png)
![detail product](docs/image-2.png)
![AJAX add cart](docs/image-5.png)
![detail cart](docs/image-6.png)
![detail fillpay](docs/image-7.png)
![checkout page](docs/image-8.png)
![alt text](docs/image-3.png)
![alt text](docs/image-4.png)
**ADMIN** 
![alt text](docs/image-9.png)
![alt text](docs/image-10.png)
![alt text](docs/image-11.png)
![alt text](docs/image-12.png)
![alt text](docs/image-13.png)
![alt text](docs/image-14.png)
![alt text](docs/image-16.png)
![alt text](docs/image-17.png)
![alt text](docs/image-15.png)

<!-- 
![Homepage](screenshots/home.png)
![Product Detail](screenshots/product-detail.png)
![Shopping Cart](screenshots/cart.png)
![Checkout](screenshots/checkout.png)
![Admin Dashboard](screenshots/admin-dashboard.png)
![Product Management](screenshots/admin-products.png)
![Order Management](screenshots/admin-orders.png)
-->
</details>
---

## 🔮 Hướng Phát Triển

- [x] Xác thực JWT với xoay vòng access + refresh token
- [x] Docker container hoá môi trường phát triển
- [x] Kích hoạt Redis cho session/cache/JWT blacklist (hạ tầng đã sẵn sàng — xem `docs/JWT_REDIS_DOCKER_GUIDE.md`)
- [x] Cơ chế giữ hàng (reservation) khi chờ thanh toán
- [x] Hoàn kho tự động khi hủy đơn
- [x] Lịch sử trạng thái đơn hàng (order status history)
- [ ] Theo dõi vận chuyển & phí ship theo khu vực
- [x] Tìm kiếm nâng cao với bộ lọc & sắp xếp
- [x] Phân quyền chi tiết (RBAC) & audit log
- [ ] Hệ thống đánh giá sản phẩm
- [ ] Tích hợp thêm cổng thanh toán (VNPay, MoMo)
- [x] Unit Test & Feature Test + CI/CD

---

## 👨‍💻 Thông Tin

- **Dự án:** Đồ án thực tập chuyên ngành
- **Đề tài:** Xây dựng hệ thống quản lý bán hàng & website bán sản phẩm công nghệ
- **Framework:** Laravel 12 + Blade + AdminLTE 4
- **Database:** MySQL/MariaDB
- **Auth:** Laravel Auth (web) + JWT (`tymon/jwt-auth`) (API)
- **DevOps:** Docker Compose (Nginx + PHP-FPM + MySQL + Redis + Node)
