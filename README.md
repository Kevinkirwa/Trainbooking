# Trainbooking
🚂💥 The Ultimate Train Booking Database System 💥🚂
Welcome to the Ultimate Train Booking Database System! This project leverages MySQL to create a robust, scalable, and efficient train booking system, complete with advanced features like dynamic pricing, real-time capacity monitoring, and a loyalty program for frequent travelers.

📝 Table of Contents
Project Overview
Features
Database Structure
How to Use
Setup Instructions
Sample Queries
Future Improvements
🎯 Project Overview
This project is designed to simulate a real-world train booking system. It includes features like station and train management, passenger bookings, dynamic fare adjustments, and cancellation handling.
Project Overview

The Train Booking System is a web-based application that allows users to book train tickets, manage bookings, and earn loyalty points. The system includes the following key components:

Home Page: Accessible to everyone, providing information about train services.

User Dashboard: For registered users to manage bookings and view loyalty points.

Admin Dashboard: For administrators to manage stations, trains, and users.

The project is designed to be responsive and user-friendly, with distinct roles for users and administrators.

The database structure is highly normalized to ensure scalability and efficiency, making it suitable for future integration with web and mobile applications.

Installation

Prerequisites

PHP (>= 7.4)

MySQL

A web server (e.g., Apache or Nginx)

A web browser

Steps

Clone the repository:
git clone https://github.com/Kevinkirwa/Trainbooking.git

Default Logins for Testing

Admin Account

Username: admin

Password: admin123

User Account

Username: kirwa

Password: kirwa123

🌟 Features
File Structure

index.php: Home page for all users.

login.php: Login page for users and admins.

register.php: Registration page for new users.

user_dashboard.php: Dashboard for regular users.

admin_dashboard.php: Dashboard for administrators.

db_connection.php: Database connection file.

style.css: Stylesheet for the project.

add_station.php: Script to add a new station (admin only).

add_train.php: Script to add a new train (admin only).

Core Features:
Dynamic Pricing: Fares vary based on demand, station distance, and train schedules.
Real-Time Seat Availability: Automatically calculates available seats per train.
Loyalty Points: Rewards frequent travelers with points for discounts.
Multi-Language Support: Includes station names in multiple languages (English and Swahili).
Cancellation Tracking: Logs cancellations with refund calculations.
Additional Functionalities:
Admin Dashboard Support: Designed to integrate with analytics tools for booking insights.
Scalable Architecture: Ready for integration with frontend applications.
🛠️ Database Structure
ERD Diagram:
![Alt text] (https://github.com/Kevinkirwa/Trainbooking/blob/main/UniqueTrainBookingSystem_ERD.png)

Tables:
Stations: Details about train stations.
Trains: Information on available trains and their capacities.
Passengers: Registered passenger details, including loyalty points.
Bookings: Tracks reservations, fares, and seat allocations.
TrainSchedules: Manages train arrival and departure times.
DynamicPricing: Stores pricing rules and demand-based multipliers.
Cancellations: Tracks refunds and cancellation history.
🚀 How to Use
Admin Users:

Populate the database with initial station, train, and schedule details.
Configure dynamic pricing rules and train capacities.
Passengers:

Book tickets through the Bookings table.
Check seat availability dynamically.
Earn loyalty points for every successful booking.
📦 Setup Instructions
Prerequisites:
MySQL Server and MySQL Workbench installed on your system.
Steps:
Clone the Repository:

bash
Copy code
git clone https://github.com/Kevinkirwa/Trainbooking.git
cd train-booking  
Import the Database:

Open MySQL Workbench.
Run the provided train_booking.sql script to set up tables and data.
Populate Data:

Use the INSERT statements in the Sample Data section to add sample records.
🧪 Sample Queries
1. Calculate Dynamic Fare for Trains:
sql
Copy code

SELECT 
    t.train_name, 
    s.station_name_en, 
    dp.base_fare * dp.demand_multiplier AS dynamic_fare
FROM DynamicPricing dp
JOIN Trains t ON dp.train_id = t.train_id
JOIN Stations s ON dp.station_id = s.station_id;

2. Monitor Real-Time Seat Availability:

sql
Copy code

SELECT 
    t.train_name, 
    t.capacity - COUNT(b.booking_id) AS available_seats
FROM Trains t
LEFT JOIN Bookings b ON t.train_id = b.train_id
GROUP BY t.train_id;

3. Loyalty Points Leaderboard:

sql
Copy code

SELECT 
    full_name, 
    loyalty_points 
FROM Passengers 
ORDER BY loyalty_points DESC;

📈 Future Improvements
Full Frontend Integration: Develop a user-friendly web or mobile app interface.
AI-Driven Pricing: Use machine learning to predict demand and adjust pricing dynamically.
Advanced Reporting: Add support for CSV export and analytics dashboards.
Real-Time Notifications: Enable SMS or email notifications for bookings and cancellations.
