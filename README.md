# ✨ StoryNest

**StoryNest** is a beautiful, interactive, and educational digital storybook platform designed specifically for children. It offers an engaging experience where parents can manage child profiles, and kids can read immersive stories in a fun, safe, and dynamically animated environment.

![Laravel 13](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS v4](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vanilla JS](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## 🚀 Core Features

- **Role-Based Authentication**: Secure access separation between Admins and Parents/Guardians.
- **Parent Dashboard**: Easily manage multiple child profiles, track reading levels, ages, and monitor recent reading history.
- **Interactive Reading UI**: A distraction-free, fullscreen-capable reader interface with smooth vanilla-JS pagination.
- **Admin Story Management**: Full CRUD operations for stories, allowing admins to publish, draft, edit, and organize stories by category.
- **Beautiful UI/UX**: Disney/Pixar-inspired aesthetics utilizing glassmorphism, soft gradients, and modern playful typography.

## 🛠 Tech Stack

- **Backend**: Laravel 13 (PHP 8.3+)
- **Frontend**: Blade Templates, Tailwind CSS v4, Vanilla JavaScript
- **Database**: SQLite (Default) / MySQL Compatible
- **Authentication**: Laravel Breeze

## ⚙️ Installation & Setup

1. **Clone the repository** (if applicable) and navigate to the project directory.

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies & Compile Assets**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   Copy the example environment file and generate your application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Note: The project defaults to SQLite. To use MySQL, update your `.env` file accordingly).*

5. **Run Migrations & Seed the Database**
   This step will set up the tables and populate the database with categories, stories, and demo accounts!
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 🔑 Demo Accounts

The database seeder automatically creates two testing accounts so you can explore the platform immediately:

### Admin Account
Has access to the Admin Dashboard to manage stories and view stats.
- **Email**: `admin@storynest.com`
- **Password**: `password`

### Parent Account
Has access to the Parent Dashboard to manage child profiles.
- **Email**: `parent@storynest.com`
- **Password**: `password`

## 📂 Project Structure Highlights

- **`app/Models/`**: Eloquent relationships and models (`ChildProfile`, `Story`, `Category`, etc.)
- **`app/Http/Controllers/`**: Core logic including `AdminController`, `DashboardController`, and `StoryController`.
- **`resources/views/`**: Contains all Blade templates neatly organized into `admin/`, `layouts/`, and `stories/`.
- **`resources/views/stories/read.blade.php`**: The interactive Vanilla JS reading interface.

---
*Built with magic for the next generation of readers! 🌟*
