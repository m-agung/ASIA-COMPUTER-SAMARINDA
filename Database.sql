CREATE DATABASE asia_computer;
USE asia_computer;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255),
    role ENUM('admin','staff','teknisi')
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150),
    phone VARCHAR(20),
    alamat TEXT,
    device VARCHAR(100),
    keluhan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    jadwal_service DATE,
    status VARCHAR(100),
    total_biaya DECIMAL(12,2),
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bulan VARCHAR(50),
    total_service INT,
    total_pendapatan DECIMAL(12,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
