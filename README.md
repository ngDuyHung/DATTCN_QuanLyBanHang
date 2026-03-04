<p align="right">
  <a href="README_VI.md">🇻🇳 Tiếng Việt</a> | <a href="README.md">🇬🇧 English</a>
</p>

# 🛒 Sales Management System & Tech Products E-Commerce Website

> A full-stack e-commerce platform built with **Laravel 12**, featuring a customer-facing shopping website and an admin management dashboard. Integrated with automatic payment processing via **SePay Webhook** and real-time order status updates via **WebSocket (Pusher)**.

<table>
  <tr>
    <td>🌐 <strong>Live Demo</strong></td>
    <td><a href="https://ecom.duyhung.io.vn" target="_blank">ecom.duyhung.io.vn</a></td>
  </tr>
  <tr>
    <td>👤 <strong>Demo Account</strong></td>
    <td><code>duyhung@gmail.com</code> / <code>duyhung456</code></td>
  </tr>
</table>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [System Architecture](#-system-architecture)
- [Database](#-database)
- [Installation & Setup](#-installation--setup)
- [Project Structure](#-project-structure)
- [Screenshots](#-screenshots)
- [Future Development](#-future-development)

---

## 🎯 Overview

An online sales system specializing in **tech products** (Laptops, PCs, RAM, components...), consisting of 2 main parts:

| Part | Description |
|------|-------------|
| **Client (Customer)** | Browse products, view details, shopping cart, checkout, order tracking |
| **Admin (Management)** | Statistics dashboard, CRUD products/categories/brands, order management, inventory, promotions, accounts |

---

## ✨ Features

### Customer Side
- 🏠 Homepage displaying products by category (Laptop, PC, RAM...)
- 🔍 Product search
- 🏷️ Smart **slug-based** product browsing (auto-detects category / brand / product)
- 📦 Product detail with image gallery & technical specifications
- 🛒 Shopping cart supporting both **guest users (session)** and **logged-in users (database)**
- 💳 Checkout with full shipping info (province/district/ward)
- 🎫 Apply discount codes (% or fixed amount) with validity checks
- 💰 Payment via COD or automatic bank transfer through **SePay**
- 📡 **Real-time** order status updates via WebSocket upon successful payment
- 📋 Order history lookup

### Admin Side
- 📊 **Dashboard** statistics: total orders, revenue, customers, monthly revenue chart
- 📁 **Category** management (CRUD, toggle active status)
- 🏢 **Brand** management by category
- 📱 **Product** management: info, thumbnail, image gallery, technical attributes (key-value)
- 📦 **Inventory** management: low stock alerts
- 🧾 **Order** management: view details, update status following valid flow (`pending → delivery → completed`)
- 🎁 **Promotion** management: create discount codes, set time limits & usage caps
- 👥 **Account** management & role-based access
- 🔧 Dynamic **menu** management & system settings

### Integration & Technical
- 🔐 **JWT Authentication** (access + refresh token rotation) for API endpoints
- 🔐 Session-based Authentication & Admin Middleware for web routes
- 🪝 Automatic payment webhook (**SePay**): receive transaction → extract order code → confirm payment
- 📡 Real-time broadcasting (**Pusher**): order status update notifications
- 🐳 **Docker** containerized development environment (Nginx + PHP-FPM + MySQL + Redis + Node)
- ⚡ Sidebar category caching to reduce DB queries
- 🖼️ Product image upload & management (Storage)

---

## 🛠 Tech Stack

### Backend
| Technology | Version | Role |
|-----------|---------|------|
| **PHP** | 8.2+ | Programming language |
| **Laravel** | 12.x | Main MVC framework |
| **Eloquent ORM** | - | Database interaction |
| **JWT Auth** (`tymon/jwt-auth`) | 2.2 | API authentication with token rotation |
| **Laravel UI** | 4.6 | Authentication scaffolding |
| **SePay Laravel** | 1.2 | Payment integration |
| **Pusher** | 7.2 | Real-time WebSocket |

### Frontend
| Technology | Role |
|-----------|------|
| **Blade Template** | Server-side rendering |
| **AdminLTE 4** | Admin panel UI |
| **Bootstrap 5** | Responsive UI framework |
| **Bootstrap Icons** | Icon set |
| **Vite** | Build tool & HMR |
| **Laravel Echo + Pusher JS** | Real-time client |
| **AJAX / Axios** | Asynchronous requests |

### Database & Infrastructure
| Technology | Role |
|-----------|------|
| **MySQL / MariaDB** | Relational DBMS |
| **Redis** | JWT blacklist, session & cache store (ready to enable) |
| **Docker + Docker Compose** | Containerized dev environment |
| **Nginx** | Reverse proxy (Docker) |
| **Laravel Migrations** | Schema management |
| **Laravel Seeder / Factory** | Sample data |

---

## 🏗 System Architecture

```
┌─────────────────────────────────────────────────────────┐
│                      CLIENT (Browser)                   │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │   Homepage   │  │  Shopping    │  │   Checkout    │  │
│  │   Products   │  │  Cart (AJAX) │  │  Place Order  │  │
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
              │ (optional)
        ┌──────────┐
        │  Redis   │
        │(Cache/BL)│
        └──────────┘
```

### JWT Authentication Flow

```
Client                            Server
  │── POST /api/auth/login ─────▸ │ Verify credentials → Issue JWT
  │◂── { access_token (60min) } ──│
  │                                │
  │── GET /api/... ──────────────▸ │ Validate JWT → Process request
  │   Authorization: Bearer {jwt}  │
  │                                │
  │── POST /api/auth/refresh ───▸  │ Blacklist old → Issue new JWT
  │◂── { new access_token } ──────│
  │                                │
  │── POST /api/auth/logout ────▸  │ Blacklist token
  │◂── { success } ───────────────│
```

---

## 🗄 Database

### Entity Relationship Diagram (ERD)

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

### Main Tables

| Table | Description |
|-------|-------------|
| `users` | Users (customers & admins) |
| `roles` | User roles (customer, admin) |
| `categories` | Product categories |
| `brands` | Brands by category |
| `products` | Products (SKU, price, description, slug...) |
| `product_images` | Product image gallery |
| `product_attributes` | Technical specs (key-value pairs) |
| `inventory` | Stock levels & low stock alerts |
| `carts` / `cart_items` | Shopping cart for logged-in users |
| `orders` / `order_items` | Orders & order line items |
| `promotions` | Discount codes & promotions |

---

## 🚀 Installation & Setup

### System Requirements
- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL / MariaDB
- Git
- **Docker Desktop** (optional — recommended for consistent environment)

### Option A: Quick Start with Docker 🐳
<details>
 <summary><strong>Click here to see the option A</strong></summary>

```bash
# 1. Clone & configure
git clone <repository-url>
cd DATTCN_QuanLyBangHang
cp .env.docker .env              # Use Docker-ready env template

# 2. Start all containers
docker compose up -d --build

# 3. Setup Laravel inside container
docker compose exec app bash
composer install
php artisan key:generate
php artisan jwt:secret           # Generate JWT signing key
php artisan migrate --seed
php artisan storage:link
exit

# 4. Access
# Web:  http://localhost:8080
# API:  http://localhost:8080/api/auth/login
```
</details>

### Option B: Manual Installation
<details>
 <summary><strong>Click here to see the option B</strong></summary>
 
```bash
# 1. Clone repository
git clone <repository-url>
cd DATTCN_QuanLyBangHang

# 2. Install dependencies
composer install
npm install

# 3. Configure environment
cp .env.example .env
php artisan key:generate
php artisan jwt:secret           # Generate JWT signing key

# 4. Configure database in .env
# DB_DATABASE=your_database
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# 5. Configure Pusher (real-time) in .env
# PUSHER_APP_ID=...
# PUSHER_APP_KEY=...
# PUSHER_APP_SECRET=...
# PUSHER_APP_CLUSTER=...

# 6. Configure SePay (payment) in .env
# SEPAY_API_TOKEN=...

# 7. Run migrations & seeders
php artisan migrate
php artisan db:seed

# 8. Link storage
php artisan storage:link

# 9. Build frontend assets
npm run build
```

### Running the Project (Development)

```bash
# Run all services simultaneously (server + queue + logs + vite)
composer dev
```

Or run each service separately:

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite dev server (HMR)
npm run dev

# Terminal 3 - Queue worker (webhook processing)
php artisan queue:listen
```

Access: `http://localhost:8000`

</details>

---

## 📂 Project Structure

```
app/
├── Events/                 # Event broadcasting (OrderStatusUpdated)
├── Helpers/                # Helper functions
├── Http/
│   ├── Controllers/
│   │   ├── admin/          # 11 admin controllers
│   │   │   ├── CategoryController      # Category CRUD
│   │   │   ├── BrandController         # Brand CRUD
│   │   │   ├── ProductController       # Product CRUD + images + attributes
│   │   │   ├── OrderController         # Order management
│   │   │   ├── InventoryController     # Inventory management
│   │   │   ├── PromotionController     # Promotion management
│   │   │   ├── AccountController       # Account management
│   │   │   ├── MenuController          # Menu management
│   │   │   └── SettingController       # System settings
│   │   ├── client/         # 7 client-side controllers
│   │   │   ├── ProductController       # Product browsing & slug routing
│   │   │   ├── CartController          # Shopping cart (session + DB)
│   │   │   ├── OrderController         # Checkout & order placement
│   │   │   └── SearchController        # Product search
│   │   └── HomeController.php          # Homepage + Dashboard
│   └── Middleware/         # Auth, Admin middleware
├── Listeners/              # SePayWebhookListener (payment processing)
├── Models/                 # 14 Eloquent models
├── Observers/              # InventoryObserver
└── Providers/              # AppServiceProvider, ViewServiceProvider (cache)

resources/views/
├── admin/                  # Admin Blade views (AdminLTE)
│   ├── dashboard.blade.php
│   ├── category/, brand/, product/, order/
│   ├── inventory/, promotion/, account/
│   └── setting/, menu/
├── client/                 # Customer Blade views
│   ├── home.blade.php
│   ├── product.blade.php, showbyslug.blade.php
│   ├── cart.blade.php, checkout.blade.php
│   ├── order_success.blade.php, topup.blade.php
│   └── ordersHistory.blade.php
├── layouts/                # Shared layouts
└── auth/                   # Login / Register

database/migrations/        # 16 migration files
database/seeders/           # Sample data
```

---

## 📸 Screenshots
<details>
 <summary><strong>Click here to see the full sreanshots</strong></summary>

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

## 🔮 Future Development

- [x] JWT Authentication with access + refresh token rotation
- [x] Docker containerized development environment
- [x] Enable Redis for session/cache/JWT blacklist (infrastructure ready — see `docs/JWT_REDIS_DOCKER_GUIDE.md`)
- [x] Stock reservation mechanism during payment pending
- [X] Automatic stock restoration on order cancellation
- [X] Order status history tracking
- [ ] Shipping tracking & region-based shipping fees
- [x] Advanced search with filters & sorting
- [X] Granular role-based access control (RBAC) & audit logs
- [ ] Product review & rating system
- [ ] Additional payment gateways (VNPay, MoMo)
- [X] Unit Tests & Feature Tests + CI/CD

---

## 👨‍💻 About

- **Project:** Internship Graduation Project
- **Topic:** Building a Sales Management System & Tech Products E-Commerce Website
- **Framework:** Laravel 12 + Blade + AdminLTE 4
- **Database:** MySQL/MariaDB
- **Auth:** Laravel Auth (web) + JWT (`tymon/jwt-auth`) (API)
- **DevOps:** Docker Compose (Nginx + PHP-FPM + MySQL + Redis + Node)
