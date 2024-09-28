-- Create the 'plants' table
CREATE DATABASE IF NOT EXISTS planting_guide;
USE planting_guide;

CREATE TABLE IF NOT EXISTS plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plant_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    avg_temp DECIMAL(5, 2) NOT NULL,
    sunlight ENUM('full sun', 'partial sun', 'shade') NOT NULL,
    water_availability ENUM('low', 'moderate', 'high') NOT NULL,
    humidity ENUM('low', 'moderate', 'high') NOT NULL,
    soil_quality ENUM('sandy', 'loamy', 'clay', 'peaty', 'chalky', 'silty') NOT NULL,
    soil_ph_min DECIMAL(4, 2) NOT NULL,
    soil_ph_max DECIMAL(4, 2) NOT NULL
);

-- Insert sample data
INSERT INTO plants (plant_name, location, avg_temp, sunlight, water_availability, humidity, soil_quality, soil_ph_min, soil_ph_max)
VALUES
('Mango', 'Maharashtra', 27.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Coconut', 'Kerala', 28.00, 'full sun', 'high', 'high', 'sandy', 5.50, 7.00),
('Tomato', 'Punjab', 24.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Wheat', 'Haryana', 25.00, 'full sun', 'moderate', 'low', 'silty', 6.00, 7.50),
('Rice', 'West Bengal', 26.00, 'full sun', 'high', 'high', 'clay', 5.00, 6.50),
('Orange', 'Nagpur', 30.00, 'full sun', 'moderate', 'low', 'loamy', 6.00, 7.00),
('Grapes', 'Nashik', 23.00, 'partial sun', 'moderate', 'low', 'chalky', 6.50, 8.00),
('Cotton', 'Gujarat', 28.00, 'full sun', 'low', 'moderate', 'sandy', 6.50, 8.00),
('Pomegranate', 'Rajasthan', 30.00, 'full sun', 'low', 'low', 'loamy', 6.50, 8.00),
('Sugarcane', 'Uttar Pradesh', 27.00, 'full sun', 'high', 'high', 'clay', 6.00, 7.50);
