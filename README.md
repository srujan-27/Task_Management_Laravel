<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



# 📝 Task Management App – Laravel

A simple and clean Laravel-based task management application. It allows users to create, edit, delete, and reorder tasks using drag-and-drop, with all data saved in a MySQL database. Tasks can also be associated with projects, and users can filter tasks by project using a dropdown menu.

---

## 🚀 Features

- ✅ Create a new task (with name, optional project)
- ✅ Edit and delete tasks
- ✅ Tasks stored in MySQL with auto-managed priority
- ✅ Drag-and-drop to reorder tasks in the UI
- ✅ Reordering updates priority values dynamically
- ✅ Filter tasks by associated project
- ✅ Built using Laravel’s MVC structure

---

## 🧰 Tech Stack

- Laravel 12.x
- PHP 8.2
- MySQL 5.7+/8+
- Blade Templates
- Bootstrap 5 (UI Styling)
- jQuery + jQuery UI (for drag-and-drop)
- XAMPP (Recommended for local development)

---

## 🛠️ Setup Instructions

### 1. Clone the Repository

```bash
1. git clone https://github.com/srujan-27/Task_Management_Laravel.git
cd Task_Management_Laravel

2. Install PHP Dependencies
Make sure Composer is installed.

composer install

3. Setup the Environment

cp .env.example .env
php artisan key:generate

4. configure MySQL in .env
Update the .env file with your database info:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskmanager
DB_USERNAME=root
DB_PASSWORD=
you need to make sure the database "taskmanager" is already created in phpMyAdmin or MySQL Workbench. can create easily one by visiting localhost/phpmyadmin after starting the server in xampp.

5. Run Migrations

php artisan migrate

6.  Start the Laravel Server

php artisan serve
Visit the app at:

http://127.0.0.1:8000

Author
Sai Srujan Vemula
Portfolio:https://portfolio-srujan27s-projects.vercel.app/
GitHub:https://github.com/srujan-27
