# Computers World

A full-featured e-commerce web application for computers, consoles, accessories, and gift cards.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Screenshots](#screenshots)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Database](#database)
- [Setup & Installation](#setup--installation)
- [Usage](#usage)
- [Admin Panel](#admin-panel)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

Computers World is an online store built with PHP, MySQL, HTML, CSS, and JavaScript. It allows users to browse, search, and purchase a wide range of computer hardware, gaming consoles, accessories, and digital gift cards. The project includes a user-facing storefront and an admin dashboard for managing products, orders, and users.

---

## Features

- User authentication (sign up, login, account management)
- Product catalog with categories (Computers, Consoles, Accessories, Cards, etc.)
- Product search and filtering
- Shopping cart and wishlist functionality
- Order placement and order history
- Newsletter subscription
- Contact form and About page
- Responsive design
- Admin panel for product, order, and user management
- Animated icons and modern UI

---
### Video Preview

[![Watch the demo](screenshot.png)](https://www.youtube.com/watch?v=hLFWM5bls1c)

---

## Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Backend:** PHP 8+
- **Database:** MySQL / MariaDB
- **Other:** Bootstrap (for some admin UI), FontAwesome, Lordicon, Lottie

---

## Project Structure

```
Web-Project/
│
├── Admin/                # Admin dashboard (PHP, JS, CSS)
├── CSS/                  # Stylesheets for main site
├── HTML/                 # Main site pages (PHP/HTML)
├── IMG/                  # Images and icons
├── Scripts/              # JavaScript files
├── Server/               # SQL scripts and DB connection
├── codesql.sql           # Main database schema and seed data
├── README.md             # This file
└── ...
```

---

## Database

- The main schema and seed data are in [`codesql.sql`](codesql.sql).
- Includes tables for users, products, orders, cart, wishlist, etc.
- To set up, import the SQL file into your MySQL/MariaDB server.

---

## Setup & Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/Web-Project.git
   ```

2. **Database setup:**

   - Create a database (e.g., `my_proj`).
   - Import `codesql.sql` into your database.

3. **Configure database connection:**

   - Edit `/Server/connection.php` and `/Admin/server/connection.php` with your DB credentials.

4. **Web server setup:**

   - Place the project in your web server's root (e.g., `htdocs` for XAMPP).
   - Ensure PHP and MySQL are running.

5. **Access the site:**
   - Open `http://localhost/Web-Project/HTML/index.php` in your browser.

---

## Usage

- **Browse products:** Navigate by category or search.
- **Add to cart/wishlist:** Use the icons on product cards.
- **Checkout:** Go to the cart and place an order (login required).
- **Account:** Manage your profile and view order history.
- **Admin:** Log in as an admin to manage products, orders, and users.

---

## Admin Panel

- Accessible at `/Web-Project/Admin/index.php`
- Requires an admin account (see `users` table, `role=1`)
- Features: dashboard, product management, order management, user management

---

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project is for educational purposes.

---
