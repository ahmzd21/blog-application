---
description: Deploy the Laravel application to free hosting
---

# Free Deployment Options for Laravel Application

This guide covers multiple free hosting solutions for your Laravel markdown editor application.

## Option 1: Railway.app (Recommended - Easiest)

Railway offers $5 free credit monthly, which is enough for small projects.

### Prerequisites
- GitHub account
- Git repository for your project

### Steps

1. **Prepare your application**
   ```bash
   # Ensure your .gitignore includes these
   echo "/vendor" >> .gitignore
   echo "/node_modules" >> .gitignore
   echo "/.env" >> .gitignore
   echo "/public/hot" >> .gitignore
   echo "/public/storage" >> .gitignore
   echo "/storage/*.key" >> .gitignore
   ```

2. **Create a Procfile in your project root**
   ```bash
   echo "web: php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=\$PORT" > Procfile
   ```

3. **Create nixpacks.toml for build configuration**
   ```bash
   cat > nixpacks.toml << 'EOF'
[phases.setup]
nixPkgs = ['php82', 'php82Packages.composer', 'nodejs_20']

[phases.install]
cmds = ['composer install --no-dev --optimize-autoloader', 'npm install', 'npm run build']

[start]
cmd = 'php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT'
EOF
   ```

4. **Push to GitHub**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git branch -M main
   git remote add origin <your-github-repo-url>
   git push -u origin main
   ```

5. **Deploy on Railway**
   - Go to https://railway.app
   - Sign up/Login with GitHub
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repository
   - Railway will auto-detect Laravel and deploy

6. **Configure Environment Variables**
   In Railway dashboard, add these variables:
   - `APP_KEY`: Generate with `php artisan key:generate --show`
   - `APP_ENV`: production
   - `APP_DEBUG`: false
   - `DB_CONNECTION`: sqlite
   - `DB_DATABASE`: /app/database/database.sqlite
   - `SESSION_DRIVER`: file
   - `QUEUE_CONNECTION`: sync

---

## Option 2: Render.com (Good Alternative)

Render offers free tier with 750 hours/month.

### Steps

1. **Create render.yaml in project root**
   ```bash
   cat > render.yaml << 'EOF'
services:
  - type: web
    name: markdown-editor
    env: php
    buildCommand: |
      composer install --no-dev --optimize-autoloader
      npm install
      npm run build
      php artisan config:cache
      php artisan route:cache
      php artisan view:cache
    startCommand: |
      php artisan migrate --force
      php artisan storage:link
      php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_KEY
        generateValue: true
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: DB_CONNECTION
        value: sqlite
      - key: DB_DATABASE
        value: /opt/render/project/src/database/database.sqlite
      - key: SESSION_DRIVER
        value: file
      - key: QUEUE_CONNECTION
        value: sync
EOF
   ```

2. **Push to GitHub** (same as Railway steps 4)

3. **Deploy on Render**
   - Go to https://render.com
   - Sign up/Login with GitHub
   - Click "New" → "Blueprint"
   - Connect your GitHub repository
   - Render will use render.yaml for deployment

---

## Option 3: Fly.io (Most Flexible)

Fly.io offers generous free tier with 3 shared VMs.

### Steps

1. **Install Fly CLI**
   ```bash
   curl -L https://fly.io/install.sh | sh
   ```

2. **Login to Fly**
   ```bash
   flyctl auth login
   ```

3. **Initialize Fly app**
   ```bash
   flyctl launch
   ```
   - Choose app name
   - Select region closest to you
   - Don't deploy yet when asked

4. **Create fly.toml configuration**
   The launch command creates this, but verify it looks like:
   ```toml
   app = "your-app-name"
   primary_region = "your-region"

   [build]
     [build.args]
       NODE_VERSION = "20"
       PHP_VERSION = "8.2"

   [env]
     APP_ENV = "production"
     LOG_CHANNEL = "stderr"
     LOG_LEVEL = "info"
     DB_CONNECTION = "sqlite"
     DB_DATABASE = "/app/database/database.sqlite"

   [[services]]
     internal_port = 8080
     protocol = "tcp"

     [[services.ports]]
       handlers = ["http"]
       port = 80

     [[services.ports]]
       handlers = ["tls", "http"]
       port = 443

   [http_service]
     internal_port = 8080
     force_https = true
     auto_stop_machines = true
     auto_start_machines = true
     min_machines_running = 0
   ```

5. **Create Dockerfile**
   ```bash
   cat > Dockerfile << 'EOF'
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Create SQLite database
RUN touch /app/database/database.sqlite

# Set permissions
RUN chmod -R 775 /app/storage /app/bootstrap/cache
RUN chmod 664 /app/database/database.sqlite

# Generate optimizations
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 8080

CMD php artisan migrate --force && \
    php artisan storage:link && \
    php artisan serve --host=0.0.0.0 --port=8080
EOF
   ```

6. **Set secrets**
   ```bash
   flyctl secrets set APP_KEY=$(php artisan key:generate --show)
   ```

7. **Deploy**
   ```bash
   flyctl deploy
   ```

---

## Option 4: InfinityFree (Traditional PHP Hosting)

Free traditional PHP hosting with MySQL database.

### Limitations
- No SSH access
- No Composer on server
- Must upload built files

### Steps

1. **Build locally**
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install && npm run build
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Sign up at InfinityFree**
   - Go to https://infinityfree.net
   - Create account and hosting
   - Note your MySQL credentials

3. **Update .env for MySQL**
   ```
   DB_CONNECTION=mysql
   DB_HOST=your-db-host
   DB_PORT=3306
   DB_DATABASE=your-db-name
   DB_USERNAME=your-db-user
   DB_PASSWORD=your-db-password
   ```

4. **Upload via FTP**
   - Upload all files to htdocs folder
   - Point document root to /public folder

5. **Run migrations**
   - Access yourdomain.com/migrate-setup.php (create this helper file)

**Note**: This option is not recommended for Laravel due to limitations.

---

## Recommended Choice

**For your Laravel application, I recommend Railway.app or Render.com** because:

1. ✅ Easy GitHub integration
2. ✅ Automatic deployments on git push
3. ✅ Support for SQLite (no need to change DB)
4. ✅ Free tier is sufficient for development/portfolio
5. ✅ Proper Laravel support with Composer and NPM
6. ✅ HTTPS included
7. ✅ Easy environment variable management

**Railway is the easiest** - just push to GitHub and connect the repo. It auto-detects Laravel and handles everything.

## Important Notes

### Storage Considerations
Your app uses Spatie Media Library for file uploads. On free hosting:
- **Railway/Render/Fly**: Files are ephemeral (deleted on redeploy)
- **Solution**: Use cloud storage (Cloudinary free tier, AWS S3 free tier)

### To add Cloudinary (Free tier - 25GB storage)

1. Install package:
   ```bash
   composer require cloudinary-labs/cloudinary-laravel
   ```

2. Configure in .env:
   ```
   CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
   FILESYSTEM_DISK=cloudinary
   ```

3. Update config/filesystems.php to add cloudinary disk

This ensures uploaded images persist across deployments.
