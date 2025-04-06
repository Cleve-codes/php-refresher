# Book Management System

This is a simple Book Management System built with PHP and SQLite. It allows users to register, log in, and manage their favorite books.

## Features

- **User Authentication**: Register and log in with secure password hashing.
- **Book Management**: Add, edit, delete, and view books.
- **Responsive UI**: Clean and responsive user interface using HTML and CSS.
- **SQLite Database**: Easy setup with SQLite for storing user and book data.

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/book-management-system.git
   cd book-management-system
   ```

2. **Set up the environment**:
   - Ensure you have PHP and SQLite installed on your system.
   - Set the appropriate permissions for the `database` directory:
     ```bash
     chmod 777 database
     ```

3. **Start the PHP development server**:
   ```bash
   cd public
   php -S localhost:8000
   ```

4. **Access the application**:
   - Open your web browser and go to `http://localhost:8000`.

## Usage

- **Register**: Create a new account by providing a username and password.
- **Log In**: Access your account using your credentials.
- **Manage Books**: Add new books, edit existing ones, or delete them from your list.
- **Log Out**: Securely log out of your account.

## Project Structure

- `config/`: Contains the database configuration file.
- `database/