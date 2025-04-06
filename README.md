# 📚 Simple Book Management System Using PHP

A modern, secure, and user-friendly web application for managing your personal book collection. Built with PHP and SQLite, this system allows users to maintain their reading list with detailed information about each book.

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue)
![SQLite](https://img.shields.io/badge/SQLite-3-green)

## ✨ Features

- **🔐 Secure User Authentication**
  - User registration with password hashing
  - Secure login system
  - Session management
  - Password protection

- **📖 Book Management**
  - Add new books with detailed information
  - Edit existing book details
  - Delete unwanted books
  - View all your books in one place
  - Year validation for publication dates

- **🎨 User Interface**
  - Clean and intuitive design
  - Responsive layout for all devices
  - User-friendly forms
  - Error handling with clear messages
  - Success notifications

- **🛡️ Security Features**
  - Password hashing using PHP's secure algorithms
  - Protection against SQL injection
  - XSS prevention
  - CSRF protection
  - Input validation and sanitization

## 🚀 Quick Start

### Prerequisites

- PHP 8.0 or higher
- SQLite3 support
- Apache/Nginx web server
- mod_rewrite enabled (for Apache)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Cleve-codes/simple-book-management-system.git
   cd book-management-system
   ```

2. **Set up permissions**
   ```bash
   # Make database directory writable
   chmod 777 database
   
   # Set proper permissions for other directories
   chmod 755 public config includes
   ```

3. **Configure web server**
   - For Apache: .htaccess is already included
   - For Nginx: Configure URL rewriting

4. **Start development server**
   ```bash
   cd public
   php -S localhost:8000
   ```

5. **Access the application**
   - Open your browser
   - Visit `http://localhost:8000`
   - Register a new account to get started

## 📁 Project Structure

```
book-management-system/
├── config/             # Configuration files
│   └── database.php   # Database connection settings
├── database/          # SQLite database storage
├── includes/          # PHP includes
│   └── init.php      # Application initialization
├── public/            # Public web root
│   ├── css/          # Stylesheets
│   ├── index.php     # Entry point
│   ├── login.php     # Login handler
│   ├── register.php  # Registration handler
│   └── ...          # Other public files
└── README.md         # This file
```

## 🔧 Configuration

The application uses SQLite by default and requires minimal configuration:

1. Database location is configured in `config/database.php`
2. Session settings can be adjusted in `includes/init.php`

## 🌟 Usage

1. **Registration**
   - Click "Register" on the login page
   - Enter username and password
   - Submit the form to create account

2. **Login**
   - Enter your credentials
   - Access your personal dashboard

3. **Managing Books**
   - Add new books using the form
   - Edit existing books via the edit button
   - Delete books with the delete button
   - View all your books on the dashboard


## 🔍 Testing

1. Test all features:
   - User registration
   - Login/logout
   - Book management
   - Form validation


