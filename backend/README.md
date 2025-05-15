# 🦠 Contact Tracing Web Application

A web-based COVID-19 contact tracing system developed using **Laravel 7**. This system enables efficient tracking of citizens, their health status, and barangay-level COVID-19 outbreaks. It includes an admin dashboard for monitoring, reporting, and managing citizen registrations.

---

## 🧰 Tech Stack

- **Backend**: Laravel 7
- **Frontend**: Bootstrap 4, jQuery
- **Local Server**: XAMPP (Apache + PHP) - default setup
- **Database**: MySQL (via Docker container) - recently added
- **Package Managers**: Composer, NPM
- **Environment**: WSL 2 (for Docker)  - recently added
- **Containerization**: Docker (MySQL only)  - recently added

---

## 🚀 Features

- ✅ Citizen registration and contact tracing
- ✅ Admin panel for user and data management
- ✅ Health status and barangay tracking
- ✅ Login/Logout authentication for admin panel
- ✅ Barangay-level COVID-19 status view
- ✅ Export reports (CSV, PDF)
- ✅ Responsive layout using Bootstrap

---

## 📦 Installation & Setup

### ✅ Requirements

- [XAMPP](https://www.apachefriends.org/index.html)
- [Docker Desktop](https://www.docker.com/) with **WSL 2 backend** - recently added
- [Composer](https://getcomposer.org/) v2.x
- [Node.js](https://nodejs.org/) v20.x
- **PHP 7.4**
- **MySQL 8** (via Docker) - recently added

---

## 🛠️ Install Dependencies

After cloning the project, install the PHP and JavaScript dependencies:

### 1. Install PHP Dependencies

```bash
composer install
```
### 2. Install & Build Node Dependencies
```bash
npm install
```
```bash
npm run dev
```
### 3. For Production
```bash
npm run build
```
   

## 💣 How to Run the Application

### 🐘 1. Using XAMPP (Apache + Local MySQL) - default setup

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL** services
3. Ensure your `.env` database settings match XAMPP's MySQL config:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=contact_tracing
    DB_USERNAME=root
    DB_PASSWORD=contact_tracing
    ```
4. Run the following Laravel setup commands:

    ```bash
    php artisan migrate
    php artisan db:seed
    php artisan serve
    ```

5. Open your browser and visit:  
   [http://localhost:8000](http://localhost:8000)

---

### 🐳 2. Using WSL 2 + Docker (MySQL Container)

1. Start the MySQL container using Docker Compose:

    ```bash
    docker-compose up --build -d
    ```

2. Update your `.env` file to connect to the Docker MySQL instance:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=contact_tracing
    DB_USERNAME=root
    DB_PASSWORD=contact_tracing
    ```

3. Run the Laravel database setup commands:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

4. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

5. Access your app at:  
   [http://localhost:8000](http://localhost:8000)

> 💡 Docker Database will be on `localhost:3306`
