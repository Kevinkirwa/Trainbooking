-- Database Setup
CREATE DATABASE UniqueTrainBooking;
USE UniqueTrainBooking;

-- Stations Table
CREATE TABLE Stations (
    station_id INT AUTO_INCREMENT PRIMARY KEY,
    station_name_en VARCHAR(100) NOT NULL, -- English name
    station_name_sw VARCHAR(100),          -- Swahili name
    location VARCHAR(255),
    region VARCHAR(100)
);

-- Trains Table
CREATE TABLE Trains (
    train_id INT AUTO_INCREMENT PRIMARY KEY,
    train_name VARCHAR(100) NOT NULL,
    train_code VARCHAR(50) UNIQUE,
    capacity INT NOT NULL
);

-- Passengers Table
CREATE TABLE Passengers (
    passenger_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    contact_number VARCHAR(15),
    loyalty_points INT DEFAULT 0 -- Accumulated points
);

-- Bookings Table
CREATE TABLE Bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    passenger_id INT,
    train_id INT,
    station_id INT,
    seat_number INT,
    fare DECIMAL(10, 2),
    booking_date DATE NOT NULL,
    FOREIGN KEY (passenger_id) REFERENCES Passengers(passenger_id),
    FOREIGN KEY (train_id) REFERENCES Trains(train_id),
    FOREIGN KEY (station_id) REFERENCES Stations(station_id)
);
-- creating users
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT 0
);

-- TrainSchedules Table
CREATE TABLE TrainSchedules (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    train_id INT,
    station_id INT,
    arrival_time TIME,
    departure_time TIME,
    FOREIGN KEY (train_id) REFERENCES Trains(train_id),
    FOREIGN KEY (station_id) REFERENCES Stations(station_id)
);

-- DynamicPricing Table
CREATE TABLE DynamicPricing (
    pricing_id INT AUTO_INCREMENT PRIMARY KEY,
    train_id INT,
    station_id INT,
    base_fare DECIMAL(10, 2),
    demand_multiplier DECIMAL(3, 2), -- e.g., 1.5 for peak demand
    FOREIGN KEY (train_id) REFERENCES Trains(train_id),
    FOREIGN KEY (station_id) REFERENCES Stations(station_id)
);

-- Cancellations Table
CREATE TABLE Cancellations (
    cancellation_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    cancellation_date DATE,
    refund_percentage DECIMAL(5, 2),
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
);

INSERT INTO Stations (station_name_en, station_name_sw, location, region)
VALUES 
    ('Nairobi Central', 'Kituo Kikuu Nairobi', 'Nairobi', 'Central'),
    ('Mombasa Terminal', 'Kituo cha Mombasa', 'Mombasa', 'Coastal'),
    ('Kisumu Central', 'Kituo Kikuu Kisumu', 'Kisumu', 'Western');
INSERT INTO Trains (train_name, train_code, capacity)
VALUES 
    ('Express Train', 'EXP001', 300),
    ('Intercity Train', 'INT002', 200),
    ('Coastal Train', 'CST003', 250);

    INSERT INTO Passengers (full_name, email, contact_number, loyalty_points)
VALUES 
    ('Alice Kimani', 'alice@example.com', '0721234567', 50),
    ('Brian Otieno', 'brian@example.com', '0732123456', 30),
    ('Catherine Njoroge', 'catherine@example.com', '0743123456', 80);

INSERT INTO DynamicPricing (train_id, station_id, base_fare, demand_multiplier)
VALUES 
    (1, 1, 500, 1.2), -- Nairobi Central
    (1, 2, 1200, 1.5), -- Mombasa Terminal
    (2, 3, 800, 1.1);  -- Kisumu Central

