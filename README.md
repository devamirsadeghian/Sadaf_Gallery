# 🚀 Sadaf Gallery

---

# ✨ Overview

This project is built with **Laravel** and the **Blade** templating engine. In addition to the web interface, it provides a collection of RESTful APIs that can be used for mobile applications, third-party integrations, or any API-driven frontend.

The project follows Laravel's best practices and emphasizes clean architecture, readability, and maintainability. Every effort has been made to keep the codebase organized, modular, and easy to extend.

---

## About the Project

This project is built with **Laravel** and the **Blade** templating engine. In addition to the web application, it includes a set of RESTFULL APIs that can be used for third-party integrations, mobile applications, or any other API-driven services.
The project has been developed with a strong focus on clean architecture, code readability, and Laravel best practices. The directory structure, file organization, and overall codebase are intentionally kept clean and consistent, making the project easy to understand, maintain, and extend.
The goal is to provide a well-structured, maintainable, and developer-friendly codebase that can serve as a solid foundation for future development.


# 🔥 Features

* Clean and organized Laravel architecture
* Blade-based responsive frontend
* RESTFULL API implementation
* Authentication using Laravel Sanctum
* Role & Permission management
* CRUD operations
* Request validation
* Eloquent ORM relationships
* Reusable components
* Clean routing structure
* Scalable project architecture

---

## Architecture Highlights

- MVC Architecture
- Service Layer
- Repository Pattern (where applicable)
- RESTFULL API Design
- Laravel Form Requests
- Policy & Middleware Authorization
- Eloquent ORM

---

# 🛠️ Packages

This project integrates several well-established Laravel packages:

| Package                       | Purpose                            |
| ----------------------------- | ---------------------------------- |
| **Laravel Sanctum**           | API Authentication                 |
| **Spatie Laravel Permission** | Roles & Permissions                |

---

# 💻 Code Quality

The project was developed with a strong emphasis on software engineering principles.

### Development Goals

* Clean Code
* Laravel Best Practices
* SOLID-friendly architecture
* Readability
* Maintainability
* Scalability
* Consistent folder structure
* Modular components
* Reusable business logic

The objective is to create a codebase that is easy for other developers to understand, maintain, and extend.

---

# 🌐 API

The application includes RESTFULL APIs that can be consumed independently from the Blade frontend.

The API architecture allows easy integration with:

* Mobile Applications
* React
* Vue
* Third-party Services
* External Systems

Authentication is handled securely using **Laravel Sanctum**.

---

# ⚙️ Installation

```bash
git clone https://github.com/devamirsadeghian/Sadaf_Gallery.git

cd project-name

composer install

php artisan migrate --seed

npm install

php artisan serve

```

---

# 📦 Additional Setup

If you're installing the project from scratch, make sure the required packages are installed and configured.

### Laravel Sanctum

```bash

composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

```


### Spatie Permission


```bash

composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

php artisan key:generate

```

---

# 📄 License

This project is intended for educational and portfolio purposes.

