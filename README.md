# Laravel E-Commerce Project

## 📌 Project Overview
This is a Laravel-based e-commerce application built as part of the MJ Technolabs assignment.  
It includes **role-based authentication** (Admin, Vendor, User) and core modules like Products, Categories, Orders, Cart, and Checkout.

---

## ⚙️ Requirements
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & npm
- Laravel 10+

---

## 🚀 Installation & Setup

### Clone the repository
```bash
git clone https://github.com/yourusername/laravel-ecommerce.git
cd laravel-ecommerce
Install dependencies
bash
Copy code
composer install
npm install && npm run dev
Environment setup
Copy .env.example to .env

Update database credentials:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
Generate application key:

bash
Copy code
php artisan key:generate
Run migrations & seeders
bash
Copy code
php artisan migrate:fresh --seed
This will create tables and populate demo data for Admin, Vendor, and User.

Start development server
bash
Copy code
php artisan serve
Access the application at http://localhost:8000

🔑 Default Credentials
Role	Email	Password
Admin	admin@example.com	password
Vendor	vendor1@example.com	password
User	user@example.com	password

📂 Project Structure
pgsql
Copy code
app/
 ┣ Http/
 ┃ ┣ Controllers/
 ┃ ┃ ┣ Admin/
 ┃ ┃ ┣ Vendor/
 ┃ ┃ ┣ User/
 ┃ ┃ ┗ Auth/
 ┃ ┣ Middleware/
 ┣ Models/
bootstrap/
config/
database/
 ┣ migrations/
 ┣ seeders/
public/
resources/
 ┣ views/
 ┣ js/
 ┣ css/
routes/
 ┣ web.php
 ┣ api.php
🧪 Features Implemented
✅ Role-based authentication (Admin, Vendor, User)

✅ Product & Category management

✅ Shopping Cart & Checkout

✅ Order history & invoices

✅ Admin sales reports

✅ Vendor product & order management

📬 Contribution
This is primarily a solo assignment. For contributions or improvements, fork the repository and submit a pull request.

📝 License
This project is for educational purposes and as part of MJ Technolabs assignment.

pgsql
Copy code

I can also **create a ready-to-download PDF version** of this README.md for your GitHub repo if you want, so it’s easy to attach with your project.  

Do you want me to do that?
