# PHP PDO Database Wrapper

A lightweight, beginner-friendly PHP PDO wrapper that simplifies database operations while promoting secure coding practices through prepared statements.

This class helps developers perform CRUD operations more efficiently by reducing repetitive code and automatically handling prepared statements to prevent SQL Injection attacks.

---

## 📌 What Is PDO?

**PDO (PHP Data Objects)** is a PHP extension that provides a consistent interface for accessing databases.

PDO supports multiple database systems including:

- MySQL
- PostgreSQL
- SQLite
- Oracle
- SQL Server

### Benefits of PDO

✅ Secure prepared statements  
✅ Protection against SQL Injection  
✅ Cleaner database code  
✅ Better error handling  
✅ Database portability  
✅ Object-oriented approach

---

## 🚀 Features

- Simple database connection
- Automatic prepared statements
- Secure parameter binding
- Fetch single records
- Fetch multiple records
- PDO exception handling
- Reusable and lightweight

---

## 📂 Project Structure

```text
database/
│
├── Database.php
└── README.md
```

---

## 📄 Source Code

```php
<?php

class Database {
    private $host = "localhost";
    private $db_name = "your_db_name";
    private $username = "your_username";
    private $password = "your_password";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $this->conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

        } catch(PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
}
```

---

# ⚙️ Installation

### Step 1

Copy the `Database.php` file into your project.

### Step 2

Update your database credentials.

```php
private $host = "localhost";
private $db_name = "your_database_name";
private $username = "root";
private $password = "";
```

### Step 3

Create your database in MySQL.

Example:

```sql
CREATE DATABASE my_project;
```

### Step 4

Import your tables.

Example:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100)
);
```

---

# 📖 How To Use

## Initialize Database

```php
$db = new Database();
```

---

## Insert Data

```php
$db->query(
    "INSERT INTO users (full_name, email) VALUES (?, ?)",
    ["John Doe", "john@example.com"]
);
```

---

## Fetch Single Row

```php
$user = $db->fetch(
    "SELECT * FROM users WHERE id = ?",
    [1]
);

print_r($user);
```

Example Output:

```php
Array
(
    [id] => 1
    [full_name] => John Doe
    [email] => john@example.com
)
```

---

## Fetch Multiple Rows

```php
$users = $db->fetchAll(
    "SELECT * FROM users"
);

print_r($users);
```

Example Output:

```php
Array
(
    [0] => Array(...)
    [1] => Array(...)
)
```

---

## Update Data

```php
$db->query(
    "UPDATE users SET full_name = ? WHERE id = ?",
    ["Jane Doe", 1]
);
```

---

## Delete Data

```php
$db->query(
    "DELETE FROM users WHERE id = ?",
    [1]
);
```

---

# 🔒 Why Prepared Statements Matter

Bad Practice:

```php
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = $id";
```

The above code is vulnerable to SQL Injection.

---

Good Practice:

```php
$id = $_GET['id'];

$user = $db->fetch(
    "SELECT * FROM users WHERE id = ?",
    [$id]
);
```

Prepared statements automatically escape dangerous input and make your application significantly more secure.

---

# 🧠 Methods Explained

### query()

Executes any SQL query.

```php
$db->query($sql, $params);
```

Returns:

```php
PDOStatement
```

---

### fetch()

Fetches a single row.

```php
$db->fetch($sql, $params);
```

Returns:

```php
Array
```

---

### fetchAll()

Fetches multiple rows.

```php
$db->fetchAll($sql, $params);
```

Returns:

```php
Array
```

---

# ⚠️ Requirements

- PHP 7.4+
- PDO Extension Enabled
- MySQL Database

Check PDO availability:

```php
php -m | findstr pdo
```

or

```php
phpinfo();
```

---

# 🔥 Future Improvements

Possible enhancements:

- Transactions
- Pagination helper
- Query builder
- Soft deletes
- Logging system
- Connection pooling
- Environment variable support
- Singleton pattern

---

# 👨‍💻 Author

**Frank Nwafor**

Full Stack Developer

Portfolio:

🌐 https://frankstack.com.ng

---

# 📜 License

This project is free to use for personal and commercial projects.

You may modify and distribute it freely.

---

## ⭐ Support

If this project helped you, consider giving it a star on GitHub and sharing it with other developers.

Happy Coding 🚀
