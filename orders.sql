USE Mongo;  -- Change this to your actual database name

-- Drop tables if they exist
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;

-- Create users table
CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create orders table
CREATE TABLE orders (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    order_details NVARCHAR(MAX) NOT NULL,
    payment_details NVARCHAR(MAX) NOT NULL,
    status NVARCHAR(10) DEFAULT 'pending',
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(id)
);