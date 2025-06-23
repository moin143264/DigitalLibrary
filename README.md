# 📚 Digital Library Management System (DLMS)

This is a full-stack academic project built using **PHP**, **MySQL**, **HTML5**, **CSS3**, and **Bootstrap 5**. The Digital Library Management System (DLMS) enables students and administrators to manage books, track issued/returned materials, and maintain a virtual library environment. It features user and admin roles with different access controls and functionalities.

💻 **GitHub Repo**: https://github.com/moin143264/DigitalLibrary

---

## 🎓 Academic Tag

📘 **This was my 1st academic project**, built from scratch without frameworks and focusing on practical database connectivity, modular PHP design, and Bootstrap layout styling.

---

## 🛠️ Technologies Used

- **HTML5** – Markup structure  
- **CSS3** – Custom styling  
- **Bootstrap 5** – Responsive UI components  
- **PHP** – Server-side logic  
- **MySQL** – Relational database  
- **phpMyAdmin** – DB management during development

---

## 📂 Features

### 👤 User Module
- Browse available books
- Search/filter books by name, author, or category
- Register/login/logout
- View issued books and due dates

### 🛠 Admin Module
- Add/edit/delete books
- Approve/decline book issue requests
- Track user activity
- View issued/returned history
- Manage categories and users

### 🌐 General
- Clean Bootstrap UI
- Responsive design for mobile and desktop
- Error/session handling via PHP
- Secure authentication and session tracking

---

## 🚀 Getting Started

### 🧰 Prerequisites

- XAMPP/WAMP/LAMP installed  
- `Apache` and `MySQL` servers running  
- Browser + phpMyAdmin access

### 🛠 Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/moin143264/DigitalLibrary
Copy to htdocs (XAMPP)
Move the project folder into C:\xampp\htdocs\DigitalLibrary

Import the Database

Open phpMyAdmin

Create a new DB (e.g., dlms)

Import the SQL file (library.sql) from the repo

Configure DB Connection

Open /config/db.php or similar config file

Set your DB name, username, and password:

php
Copy code
$conn = new mysqli("localhost", "root", "", "dlms");
Start Server

Visit: http://localhost/DigitalLibrary

📁 Folder Structure

/DigitalLibrary
├── admin/           # Admin-specific pages
├── user/            # User-specific pages
├── includes/        # Common includes (header, DB connection)
├── css/             # Custom stylesheets
├── js/              # JS (if any)
├── library.sql      # MySQL DB structure and seed
├── index.php        # Homepage

📌 Notes
No external frameworks used – everything built from scratch

Easy to customize and extend for college/university libraries

Suitable for learning full-stack PHP + MySQL integration


