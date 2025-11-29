# 🚀 Hướng Dẫn Deploy Laravel lên Render

## 📋 Mục Lục
- [Giới Thiệu Về Render](#giới-thiệu-về-render)
- [Chuẩn Bị Deploy](#chuẩn-bị-deploy)
- [Cách 1: Deploy Tự Động (Render Blueprint)](#cách-1-deploy-tự-động-render-blueprint)
- [Cách 2: Deploy Thủ Công](#cách-2-deploy-thủ-công)
- [Cấu Hình Environment Variables](#cấu-hình-environment-variables)
- [Cấu Hình Domain](#cấu-hình-domain)
- [Monitoring & Logs](#monitoring--logs)
- [Troubleshooting](#troubleshooting)

---

## 🌐 Giới Thiệu Về Render

**Render** là platform cloud hosting hiện đại, thay thế cho Heroku:
- ✅ **Free tier** có database + web service
- ✅ **Auto deploy** từ GitHub/GitLab
- ✅ **Tích hợp SSL** tự động (HTTPS)
- ✅ **Docker support** native
- ✅ **Managed database** (PostgreSQL, MySQL, Redis)

### Pricing (Tham khảo 2025)
| Service | Free | Starter | Standard |
|---------|------|---------|----------|
| Web Service | ✅ (sleep after 15m) | $7/month | $25/month |
| MySQL | ❌ | $7/month | $15/month |
| Redis | ✅ 25MB | $10/month | $20/month |

**Khuyến nghị**: Starter plan ($14/month) cho web + database

---

## 📦 Chuẩn Bị Deploy

### 1. Push code lên GitHub

```powershell
# Nếu chưa có git repo
git init
git add .
git commit -m "Initial commit"

# Tạo repo trên GitHub: https://github.com/new
# Sau đó push
git remote add origin https://github.com/your-username/your-repo.git
git branch -M master
git push -u origin master
```

### 2. Kiểm tra các files cần thiết

Đảm bảo có các files sau trong repo:
- ✅ `Dockerfile.production`
- ✅ `docker-entrypoint.sh`
- ✅ `render.yaml` (nếu dùng Blueprint)
- ✅ `docker/nginx/production.conf`
- ✅ `docker/php/production.ini`
- ✅ `docker/supervisor/supervisord.conf`

### 3. Tạo tài khoản Render

1. Truy cập [render.com](https://render.com)
2. Sign up bằng GitHub account
3. Authorize Render truy cập repos

---

## 🎯 Cách 1: Deploy Tự Động (Render Blueprint)

**Blueprint** = Infrastructure as Code, tự động tạo tất cả services

### Bước 1: Push render.yaml lên GitHub

File `render.yaml` đã được tạo sẵn trong project.

### Bước 2: Deploy từ Blueprint

1. Vào Render Dashboard
2. Click **"New"** → **"Blueprint"**
3. Chọn repository GitHub
4. Render sẽ tự động phát hiện `render.yaml`
5. Review các services:
   - Web service (Laravel)
   - MySQL database
   - Redis
6. Click **"Apply"**

### Bước 3: Đợi deploy hoàn tất

- Render sẽ build Dockerfile.production
- Tự động tạo database + Redis
- Link các services với nhau
- Thời gian: ~5-10 phút

### Bước 4: Cấu hình thêm Environment Variables

Vào Web Service → Environment → Thêm:

```env
# Bank config (không nên commit vào render.yaml)
BANK_ID=970422
BANK_NAME=MB Bank
BANK_ACCOUNT_NO=0123456789
BANK_ACCOUNT_NAME=NGUYEN VAN A

# Mail config (nếu dùng)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### Bước 5: Trigger manual deploy (nếu cần)

```
Web Service → Manual Deploy → Deploy latest commit
```

---

## 🔧 Cách 2: Deploy Thủ Công

Nếu không dùng Blueprint, tạo từng service riêng:

### Bước 1: Tạo MySQL Database

1. Dashboard → **New** → **MySQL**
2. Điền thông tin:
   - **Name**: `laravel-mysql`
   - **Database**: `doan_thuctap_cn`
   - **Region**: Singapore (gần VN nhất)
   - **Plan**: Starter ($7/month)
3. Click **Create Database**
4. Đợi provisioning (~2-3 phút)
5. Lưu lại **Internal Connection String**

### Bước 2: Tạo Redis

1. Dashboard → **New** → **Redis**
2. Điền thông tin:
   - **Name**: `laravel-redis`
   - **Region**: Singapore
   - **Plan**: Free hoặc Starter
3. Click **Create Redis**
4. Lưu lại **Internal Redis URL**

### Bước 3: Tạo Web Service

1. Dashboard → **New** → **Web Service**
2. Connect repository từ GitHub
3. Cấu hình:
   - **Name**: `laravel-app`
   - **Region**: Singapore
   - **Branch**: `master`
   - **Environment**: Docker
   - **Dockerfile Path**: `./Dockerfile.production`
   - **Plan**: Starter ($7/month)

### Bước 4: Cấu hình Environment Variables

Vào Environment tab, thêm tất cả biến môi trường (xem phần dưới)

### Bước 5: Deploy

Click **"Create Web Service"** → Render bắt đầu build

---

## 🔐 Cấu Hình Environment Variables

### Variables bắt buộc

```env
# Application
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:xxxx  # Generate bằng php artisan key:generate
APP_DEBUG=false
APP_URL=https://your-app.onrender.com

# Database (lấy từ MySQL service Internal Connection)
DB_CONNECTION=mysql
DB_HOST=dpg-xxxxx-a.singapore-postgres.render.com
DB_PORT=3306
DB_DATABASE=doan_thuctap_cn
DB_USERNAME=laravel_user
DB_PASSWORD=xxxxx

# Redis (lấy từ Redis service Internal Connection)
REDIS_HOST=red-xxxxx.singapore-redis.render.com
REDIS_PORT=6379
REDIS_PASSWORD=xxxxx  # Nếu có

# Cache & Session
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error  # production nên dùng error, không dùng debug
```

### Variables tùy chọn

```env
# Bank config
BANK_ID=970422
BANK_NAME=MB Bank
BANK_ACCOUNT_NO=0123456789
BANK_ACCOUNT_NAME=NGUYEN VAN A

# Mail (nếu dùng Gmail SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# AWS S3 (nếu dùng cho file upload)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=
FILESYSTEM_DISK=s3
```

### Cách thêm Environment Variables

**Trong Render Dashboard:**
1. Vào Web Service
2. Tab **Environment**
3. Click **Add Environment Variable**
4. Nhập Key + Value
5. Click **Save Changes**

**Hoặc dùng Render CLI:**
```powershell
# Install Render CLI
npm install -g @render/cli

# Login
render login

# Set env var
render env set APP_KEY=base64:xxxxx --service=laravel-app
```

---

## 🌍 Cấu Hình Domain

### Dùng subdomain miễn phí của Render

Mặc định: `https://laravel-app.onrender.com`

### Dùng custom domain

1. Mua domain (Google Domains, Namecheap, etc.)
2. Vào Web Service → **Settings** → **Custom Domain**
3. Thêm domain: `yourdomain.com`
4. Render cung cấp DNS records:
   ```
   Type: CNAME
   Name: @ (hoặc www)
   Value: laravel-app.onrender.com
   ```
5. Thêm records vào DNS provider
6. Đợi propagation (~10-60 phút)
7. Render tự động issue SSL certificate (Let's Encrypt)

### Update APP_URL

Sau khi setup domain, cập nhật:
```env
APP_URL=https://yourdomain.com
```

---

## 📊 Monitoring & Logs

### Xem Logs

**Trong Dashboard:**
1. Vào Web Service
2. Tab **Logs**
3. Real-time logs stream

**Hoặc dùng CLI:**
```powershell
render logs --service=laravel-app --tail
```

### Các loại logs

| Log | Path trong container | Xem trong Render |
|-----|---------------------|------------------|
| **Application** | `/var/www/storage/logs/laravel.log` | ✅ Logs tab |
| **Nginx** | `/var/log/nginx/error.log` | ✅ Logs tab |
| **PHP-FPM** | stdout | ✅ Logs tab |
| **Queue** | `/var/www/storage/logs/queue.log` | ✅ Logs tab |

### Metrics

1. Web Service → **Metrics**
2. Xem:
   - CPU usage
   - Memory usage
   - Request rate
   - Response time

### Health Check

Render tự động ping `APP_URL/` mỗi 30s
- ✅ Status 200 → Healthy
- ❌ Timeout/5xx → Unhealthy → Auto restart

---

## 🔧 Troubleshooting

### 1. Build failed: "npm install" errors

**Nguyên nhân**: Node modules conflict hoặc package.json lỗi

**Giải pháp**:
```powershell
# Trên local, test build Docker
docker build -f Dockerfile.production -t test-build .

# Xem logs build
docker build -f Dockerfile.production -t test-build . --progress=plain

# Nếu OK, push lại code
git add .
git commit -m "Fix build"
git push
```

### 2. Database connection refused

**Nguyên nhân**: 
- Chưa link database với web service
- Environment variables sai

**Giải pháp**:
```powershell
# Kiểm tra DB_HOST có đúng Internal Connection không
# VD: dpg-xxxxx-a.singapore-postgres.render.com (KHÔNG phải external)

# Test connection trong container
render shell laravel-app
php artisan db:show
```

### 3. 500 Error sau khi deploy

**Nguyên nhân**: 
- APP_KEY chưa set
- Permissions storage/cache

**Giải pháp**:
```powershell
# Generate APP_KEY mới
php artisan key:generate --show
# Copy output và set vào Render Environment Variables

# Hoặc trong Render shell
render shell laravel-app
php artisan key:generate
php artisan config:cache
```

### 4. Assets không load (404)

**Nguyên nhân**: Vite assets chưa được build

**Giải pháp**:
```powershell
# Trên local, build assets
npm run build

# Commit public/build
git add public/build -f
git commit -m "Add built assets"
git push

# Hoặc sửa .gitignore để không ignore public/build trong production
```

### 5. Queue jobs không chạy

**Nguyên nhân**: Supervisor chưa start queue worker

**Kiểm tra**:
```powershell
# SSH vào container
render shell laravel-app

# Kiểm tra supervisor
supervisorctl status

# Nếu queue worker down
supervisorctl restart laravel-queue:*
```

### 6. Session bị mất liên tục

**Nguyên nhân**: 
- SESSION_DRIVER=file nhưng container restart
- Redis connection issue

**Giải pháp**:
```env
# Đảm bảo dùng Redis cho session
SESSION_DRIVER=redis
REDIS_HOST=xxx  # Internal Redis URL
```

### 7. Slow performance

**Nguyên nhân**:
- OPcache chưa enable
- Database query chưa optimize

**Giải pháp**:
```powershell
# Kiểm tra OPcache
render shell laravel-app
php -i | grep opcache

# Optimize Laravel
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 8. Log "Disk full"

**Nguyên nhân**: Log files quá lớn

**Giải pháp**:
```powershell
# SSH vào container
render shell laravel-app

# Xóa old logs
rm -f storage/logs/*.log
echo "" > storage/logs/laravel.log

# Hoặc config log rotation trong logging.php
'channels' => [
    'daily' => [
        'driver' => 'daily',
        'path' => storage_path('logs/laravel.log'),
        'level' => 'error',
        'days' => 7,  # Giữ 7 ngày
    ],
],
```

---

## 🔄 CI/CD: Auto Deploy

### Từ GitHub

Render tự động deploy khi push lên branch master:
```powershell
git add .
git commit -m "Update feature"
git push origin master
# → Render auto detect và rebuild
```

### Deploy từ branch khác

1. Web Service → **Settings** → **Branch**
2. Đổi từ `master` sang `production`

### Manual deploy

```powershell
# Trong Dashboard
Web Service → Manual Deploy → Deploy latest commit

# Hoặc dùng CLI
render deploy --service=laravel-app
```

### Rollback

1. Web Service → **Events**
2. Tìm deploy thành công trước đó
3. Click **Rollback**

---

## 📝 Checklist Trước Khi Deploy

- [ ] Code đã push lên GitHub
- [ ] `Dockerfile.production` đã test local
- [ ] `render.yaml` đã cấu hình đúng
- [ ] `.env.example` có đầy đủ variables
- [ ] Assets đã build (`npm run build`)
- [ ] Database migrations đã test
- [ ] APP_DEBUG=false trong production
- [ ] HTTPS redirect đã enable (Nginx config)
- [ ] Error logging đã config
- [ ] Backup database plan (nếu paid plan)

---

## 🆚 So Sánh: Dev vs Production

| Aspect | Development (docker-compose) | Production (Render) |
|--------|------------------------------|---------------------|
| **PHP** | PHP-FPM only | PHP-FPM + Nginx + Supervisor |
| **Web Server** | Nginx container riêng | Nginx trong cùng container |
| **Database** | MySQL container local | Managed MySQL (Render) |
| **Redis** | Redis container local | Managed Redis (Render) |
| **Assets** | Build trên host (npm run dev) | Pre-built trong image |
| **Logs** | docker-compose logs | Render Dashboard |
| **SSL** | Không có | Tự động (Let's Encrypt) |
| **Scaling** | Không | Horizontal scaling (paid) |
| **Health Check** | Không | Tự động monitor + restart |

---

## 🎓 Tài Liệu Tham Khảo

- [Render Documentation](https://render.com/docs)
- [Render Laravel Guide](https://render.com/docs/deploy-laravel)
- [Docker Multi-stage Builds](https://docs.docker.com/build/building/multi-stage/)
- [Nginx Best Practices](https://www.nginx.com/blog/nginx-se-api-gateway-part-1/)

---

## 💰 Chi Phí Ước Tính

### Minimum Setup (Production-ready)
```
Web Service (Starter):    $7/month
MySQL (Starter):          $7/month
Redis (Free):             $0/month
-----------------------------------
Total:                   $14/month
```

### Recommended Setup
```
Web Service (Standard):  $25/month
MySQL (Standard):        $15/month
Redis (Starter):         $10/month
-----------------------------------
Total:                   $50/month
```

### Free Tier (Cho demo/testing)
```
Web Service:    Free (sleep after 15min idle)
Redis:          Free (25MB)
MySQL:          KHÔNG có free tier
-----------------------------------
Total:          $0 (nhưng cần external MySQL)
```

---

**Chúc bạn deploy thành công! 🚀**

*Nếu gặp vấn đề, check Render status page: https://status.render.com*
