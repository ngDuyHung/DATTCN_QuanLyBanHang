<p align="right">
  <a href="README_VI.md">🇻🇳 Tiếng Việt</a> | <a href="README.md">🇬🇧 English</a>
</p>

# 🛒 Sales Management System & Tech Products E-Commerce Website

> A full-stack e-commerce platform built with **Laravel 12**, featuring a customer-facing shopping website and an admin management dashboard. Integrated with automatic payment processing via **SePay Webhook** and real-time order status updates via **WebSocket (Pusher)**.

<table>
  <tr>
    <td>🌐 <strong>Live Demo</strong></td>
    <td><a href="https://duyhung.io.vn" target="_blank">duyhung.io.vn</a></td>
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
- 🔐 Authentication & authorization (Laravel Auth + Admin Middleware)
- 🪝 Automatic payment webhook (**SePay**): receive transaction → extract order code → confirm payment
- 📡 Real-time broadcasting (**Pusher**): order status update notifications
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

### Installation Steps

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

> *Add screenshots of the interface here*

<!-- 
![Homepage](screenshots/home.png)
![Product Detail](screenshots/product-detail.png)
![Shopping Cart](screenshots/cart.png)
![Checkout](screenshots/checkout.png)
![Admin Dashboard](screenshots/admin-dashboard.png)
![Product Management](screenshots/admin-products.png)
![Order Management](screenshots/admin-orders.png)
-->

---

## 🔮 Future Development

- [ ] Stock reservation mechanism during payment pending
- [ ] Automatic stock restoration on order cancellation
- [ ] Order status history tracking
- [ ] Shipping tracking & region-based shipping fees
- [ ] Advanced search with filters & sorting
- [ ] Granular role-based access control (RBAC) & audit logs
- [ ] Product review & rating system
- [ ] Additional payment gateways (VNPay, MoMo)
- [ ] Unit Tests & Feature Tests + CI/CD

---

## 👨‍💻 About

- **Project:** Internship Graduation Project
- **Topic:** Building a Sales Management System & Tech Products E-Commerce Website
- **Framework:** Laravel 12 + Blade + AdminLTE 4
- **Database:** MySQL/MariaDB
