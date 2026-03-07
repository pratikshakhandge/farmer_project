# Farmer Management System

A simple PHP + MySQL web app for farmer account management, expense tracking by crop, and basic profit calculation.

## Features

- User registration and login
- Farmer dashboard with profile details
- Add crop expense entries (category, amount, note)
- View crop-wise expense history with totals
- Profit calculator (selling price - total expense)

## Tech Stack

- PHP (session-based auth, server-side logic)
- MySQL (data storage)
- HTML/CSS (UI)
- Vanilla JavaScript (AJAX expense save + profit calculation)
- XAMPP (Apache + MySQL recommended)

## Project Structure

```text
farmer_project/
|-- index.html          # Login page
|-- register.php        # New user registration
|-- login.php           # Login handler
|-- dashboard.php       # Main dashboard
|-- profile.php         # User profile page
|-- add_crop.php        # Add expense form
|-- save_expense.php    # Expense insert endpoint
|-- view_crops.php      # Crop expense records
|-- profit.php          # Profit calculator page
|-- logout.php          # Session logout
|-- config.php          # Database connection
|-- style.css           # Auth page styles
|-- dashboard.css       # Dashboard/pages styles
|-- image.png           # Dashboard image
|-- farmer.png          # Login image
`-- README.md
```

## Prerequisites

- XAMPP installed
- Apache running
- MySQL running
- PHP 8.x (or compatible version included with XAMPP)

## Database Setup

1. Create a database named `farmer_db`.
2. Run the SQL below:

```sql
CREATE DATABASE IF NOT EXISTS farmer_db;
USE farmer_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    mobile VARCHAR(20) DEFAULT '',
    address VARCHAR(255) DEFAULT '',
    village VARCHAR(100) DEFAULT '',
    district VARCHAR(100) DEFAULT '',
    state VARCHAR(100) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    crop_name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    note VARCHAR(255) DEFAULT '',
    expense_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Configure Connection

Update `config.php` if your MySQL settings differ:

```php
$conn = new mysqli("localhost", "root", "", "farmer_db", 3307);
```

Notes:
- `3307` is currently used in this project.
- Many XAMPP setups use `3306`.

## Run Locally (XAMPP)

1. Place project in:
   `C:\xampp\htdocs\farmer_project`
2. Start Apache and MySQL from XAMPP Control Panel.
3. Open:
   `http://localhost/farmer_project/index.html`
4. Register a user, then log in.

## Usage Flow

1. Create account on `register.php`.
2. Log in from `index.html`.
3. Add crop expenses from `add_crop.php`.
4. Check grouped crop records in `view_crops.php`.
5. Use `profit.php` to calculate profit/loss.

## Security Notes

- Passwords are hashed with `password_hash()`.
- Login verification uses `password_verify()`.
- Input is escaped in output with `htmlspecialchars()` in key pages.

## License

This project is for educational use.
