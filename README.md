# Laravel Blog Application

A modern blog application built with Laravel 12, featuring markdown support, user authentication, and media management.

## Features

- 📝 **Markdown Editor** - Write posts with EasyMDE markdown editor
- 🔐 **Authentication** - User registration and login with Laravel Breeze
- 🖼️ **Media Management** - Image uploads with Spatie Media Library
- 📂 **Categories** - Organize posts by categories
- 👤 **User Profiles** - User avatars and profile management
- 🎨 **Modern UI** - Clean, responsive design with Tailwind CSS
- 🔍 **Post Browsing** - Browse all posts with category filtering

## Tech Stack

- **Laravel 12** - PHP Framework
- **Laravel Breeze** - Authentication scaffolding
- **Spatie Media Library** - Media management
- **EasyMDE** - Markdown editor
- **Tailwind CSS** - Styling
- **Alpine.js** - JavaScript framework
- **SQLite** - Database

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd markdown_editor
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see your blog application.

## Deployment

This application is ready to deploy on Railway.app. See the [deployment guide](.gemini/antigravity/brain/cdad62ea-fda3-4154-a0a4-c5db5c232488/implementation_plan.md) for detailed instructions.

Quick start:
```bash
./railway-setup.sh
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

