# Waggy Pet Shop E-Commerce Laravel Project

## Overview
This is a feature-rich e-commerce platform built using Laravel. The application allows users to add, edit and delete items to their cart, and complete purchases through the application. Admin users can manage Category, products and orders via a dedicated admin panel. The project is designed for scalability and can serve as a foundation for building production-ready e-commerce systems.

## Features
- User registration and authentication
- Add, edit and delete to cart 
- Admin panel for managing Category, products, orders


## Setup Instructions

### Prerequisites
- PHP >= 8.1
- Xammp
- Composer
- MySQL or phpmyadmin
- Node.js and npm (for frontend asset compilation)
- Laravel Installer (optional)

### Installation Steps
1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-repo/ecommerce-laravel.git
   cd ecommerce-laravel
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Environment Configuration**
   - Copy the example `.env` file:
     ```bash
     cp .env.example .env
     ```
   - Update the following variables in `.env`:
     ```env
     APP_NAME=Ecommerce
     APP_URL=http://localhost

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=e_commerce_app
     DB_USERNAME=your_username
     DB_PASSWORD=your_password

     STRIPE_KEY=your_stripe_key
     STRIPE_SECRET=your_stripe_secret
     ```

4. **Database Setup**
   - Run migrations:
     ```bash
     php artisan migrate
     ```
   - Seed the database with demo data:if you added admin in seeders
     ```bash
     php artisan db:seed
     ```

5. **Storage Linking**
   ```bash
   php artisan storage:link
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## Usage Guidelines

### Accessing the App
- **Default URL:** `http://localhost:8000`
- **Admin Panel:** `http://localhost:8000/admin/login`(login with admins in DatabaseSeeder.php and you can add another)
- Default credentials (if seeded):
  - Admin: `admin@example.com / password`
  - User: `user@example.com / password`

### Core Features
- **User:**
  - Browse products and view details.
  - Add products to cart and complete checkout.
  - View order history in the user dashboard.
- **Admin:**
  - Add, edit, and delete Category and products.
  - Manage user accounts.
  - Track and update order statuses.

## Project Architecture

### Folder Structure
- **Controllers:** Located in `app/Http/Controllers`. Handles application logic.
- **Models:** Located in `app/Models`. Represents database entities.
- **Views:** Located in `resources/views`. Blade templates for frontend.
- **Routes:** Defined in `routes/web.php` and `routes/api.php`.
- **Migrations:** Located in `database/migrations`. Defines database schema.

### Technologies and Packages
- **Laravel Framework:** Core of the application.
- **Blade:** Templating engine for frontend.
- **Eloquent:** ORM for database interactions.
- **Spatie Laravel Permissions:** Role and permission management.
- **Livewire:** For dynamic frontend interactions (if applicable).

## Contributing
We welcome contributions to enhance this project! To contribute:
1. Fork the repository.
2. Create a new branch: `git checkout -b feature/your-feature-name`.
3. Commit your changes: `git commit -m 'Add some feature'`.
4. Push to the branch: `git push origin feature/your-feature-name`.
5. Open a pull request.

## FAQs

### Common Issues
1. **"Class not found" errors:** Ensure you run `composer dump-autoload` after adding new classes.
2. **Migrations fail:** Double-check your database credentials in the `.env` file.
