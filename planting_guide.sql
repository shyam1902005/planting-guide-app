-- Create the 'planting_guide' database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS planting_guide;
USE planting_guide;
-- Create the 'plants' table
CREATE TABLE IF NOT EXISTS plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plant_name VARCHAR(100) NOT NULL,
    avg_temp_min DECIMAL(5, 2) NOT NULL,  -- Minimum average temperature
    avg_temp_max DECIMAL(5, 2) NOT NULL,  -- Maximum average temperature
    sunlight ENUM('full sun', 'partial sun', 'shade') NOT NULL,
    water_availability ENUM('low', 'moderate', 'high') NOT NULL,
    humidity ENUM('low', 'moderate', 'high') NOT NULL,
    soil_quality ENUM('sandy', 'loamy', 'clay', 'peaty', 'chalky', 'silty') NOT NULL,
    soil_ph_min DECIMAL(4, 2) NOT NULL,  -- Minimum soil pH
    soil_ph_max DECIMAL(4, 2) NOT NULL   -- Maximum soil pH
);

-- Create the 'locations' table to store different states or regions
CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    state_name VARCHAR(100) NOT NULL
);

-- Create the 'plant_locations' junction table to represent the many-to-many relationship
CREATE TABLE IF NOT EXISTS plant_locations (
    plant_id INT NOT NULL,
    location_id INT NOT NULL,
    PRIMARY KEY (plant_id, location_id),
    FOREIGN KEY (plant_id) REFERENCES plants(id) ON DELETE CASCADE,
    FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE CASCADE
);

-- Insert example data into the 'locations' table
-- Insert all states and union territories of India into the 'locations' table
INSERT INTO locations (state_name) VALUES
('Andhra Pradesh'),
('Arunachal Pradesh'),
('Assam'),
('Bihar'),
('Chhattisgarh'),
('Goa'),
('Gujarat'),
('Haryana'),
('Himachal Pradesh'),
('Jharkhand'),
('Karnataka'),
('Kerala'),
('Madhya Pradesh'),
('Maharashtra'),
('Manipur'),
('Meghalaya'),
('Mizoram'),
('Nagaland'),
('Odisha'),
('Punjab'),
('Rajasthan'),
('Sikkim'),
('Tamil Nadu'),
('Telangana'),
('Tripura'),
('Uttar Pradesh'),
('Uttarakhand'),
('West Bengal'),
('Andaman and Nicobar Islands'),
('Chandigarh'),
('Dadra and Nagar Haveli and Daman and Diu'),
('Delhi'),
('Lakshadweep'),
('Puducherry');


-- Insert example data into the 'plants' table
-- Insert sample data into the 'plants' table
INSERT INTO plants (plant_name, avg_temp_min, avg_temp_max, sunlight, water_availability, humidity, soil_quality, soil_ph_min, soil_ph_max) VALUES
('Mango', 24.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.50),
('Rice', 21.00, 37.00, 'partial sun', 'high', 'high', 'clay', 5.00, 6.50),
('Wheat', 12.00, 25.00, 'full sun', 'moderate', 'moderate', 'sandy', 6.00, 7.50),
('Coconut', 27.00, 35.00, 'full sun', 'moderate', 'high', 'sandy', 5.50, 7.00),
('Cotton', 20.00, 35.00, 'full sun', 'low', 'low', 'sandy', 5.50, 7.00),
('Tea', 20.00, 30.00, 'partial sun', 'high', 'high', 'loamy', 4.50, 6.00),
('Banana', 18.00, 32.00, 'full sun', 'high', 'high', 'loamy', 5.50, 7.00),
('Sugarcane', 20.00, 40.00, 'full sun', 'high', 'moderate', 'loamy', 6.00, 7.50),
('Sunflower', 18.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Tomato', 16.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.50),
('Potato', 15.00, 25.00, 'partial sun', 'moderate', 'moderate', 'loamy', 5.00, 6.50),
('Apple', 13.00, 24.00, 'full sun', 'moderate', 'low', 'loamy', 5.00, 6.50),
('Peach', 10.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Pineapple', 20.00, 32.00, 'partial sun', 'high', 'high', 'loamy', 4.50, 5.50),
('Carrot', 16.00, 24.00, 'partial sun', 'moderate', 'moderate', 'sandy', 6.00, 6.80),
('Radish', 10.00, 25.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Cabbage', 15.00, 25.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Cauliflower', 15.00, 25.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Brinjal', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Okra', 24.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Pumpkin', 20.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Watermelon', 22.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Bitter Gourd', 18.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Bottle Gourd', 20.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Chili', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Onion', 18.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Garlic', 18.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Ginger', 24.00, 35.00, 'partial sun', 'high', 'moderate', 'loamy', 5.50, 6.50),
('Turmeric', 20.00, 30.00, 'partial sun', 'high', 'moderate', 'loamy', 5.50, 6.50),
('Spinach', 10.00, 30.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Lettuce', 10.00, 24.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Cucumber', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Chickpea', 18.00, 32.00, 'full sun', 'low', 'moderate', 'loamy', 6.00, 7.50),
('Pigeon Pea', 24.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.50),
('Black Gram', 25.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Green Gram', 25.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Soybean', 24.00, 34.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Mustard', 10.00, 25.00, 'full sun', 'low', 'moderate', 'loamy', 6.00, 7.50),
('Groundnut', 20.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.50),
('Sesame', 25.00, 35.00, 'full sun', 'low', 'moderate', 'loamy', 5.50, 7.50),
('Maize', 18.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.00),
('Bajra', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'sandy', 5.50, 7.50),
('Jowar', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Ragi', 18.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.50),
('Barley', 10.00, 24.00, 'full sun', 'moderate', 'low', 'loamy', 6.00, 7.00),
('Sugar Beet', 18.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Papaya', 20.00, 30.00, 'full sun', 'high', 'high', 'loamy', 5.50, 7.00),
('Grapes', 15.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.80),
('Strawberry', 10.00, 24.00, 'full sun', 'moderate', 'low', 'loamy', 5.50, 6.50),
('Pomegranate', 18.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Guava', 15.00, 30.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Lemon', 12.00, 28.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Orange', 15.00, 28.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Sweet Lime', 15.00, 28.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Lychee', 20.00, 30.00, 'full sun', 'high', 'high', 'loamy', 5.50, 7.00),
('Amla', 15.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Tamarind', 20.00, 32.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 6.50),
('Cashew', 24.00, 35.00, 'full sun', 'moderate', 'moderate', 'sandy', 5.50, 6.50),
('Pistachio', 15.00, 35.00, 'full sun', 'low', 'low', 'loamy', 5.50, 7.50),
('Almond', 15.00, 35.00, 'full sun', 'low', 'low', 'loamy', 6.00, 7.50),
('Peanut', 20.00, 35.00, 'full sun', 'moderate', 'moderate', 'loamy', 5.50, 7.50),
('Cloves', 20.00, 35.00, 'partial sun', 'high', 'high', 'loamy', 5.50, 6.50),
('Cardamom', 15.00, 30.00, 'partial sun', 'high', 'high', 'loamy', 5.50, 6.50),
('Pepper', 20.00, 32.00, 'partial sun', 'high', 'high', 'loamy', 5.50, 6.50),
('Coriander', 10.00, 30.00, 'partial sun', 'moderate', 'moderate', 'loamy', 6.00, 7.00),
('Mint', 18.00, 30.00, 'partial sun', 'high', 'moderate', 'loamy', 5.50, 6.50),
('Basil', 18.00, 30.00, 'partial sun', 'high', 'moderate', 'loamy', 5.50, 6.50),
('Rosemary', 18.00, 30.00, 'full sun', 'moderate', 'low', 'sandy', 6.00, 7.00),
('Thyme', 10.00, 25.00, 'full sun', 'moderate', 'low', 'loamy', 6.00, 7.00),
('Oregano', 15.00, 30.00, 'full sun', 'moderate', 'low', 'loamy', 6.00, 7.50),
('Saffron', 15.00, 25.00, 'full sun', 'low', 'moderate', 'loamy', 6.00, 7.50),
('Vanilla', 20.00, 32.00, 'partial sun', 'high', 'high', 'loamy', 5.50, 6.50),
('Cocoa', 24.00, 30.00, 'partial sun', 'high', 'high', 'loamy', 5.50, 6.50),
('Coffee', 18.00, 28.00, 'partial sun', 'high', 'moderate', 'loamy', 5.50, 6.50);

-- Continue with more plant data as needed.

-- Continue inserting more plants (add at least 500 plant entries with varying conditions)


-- Associate plants with multiple locations in the 'plant_locations' table
INSERT INTO plant_locations (plant_id, location_id)
VALUES
(1, 5), (1, 9), (1, 22), (2, 7), (2, 15),
(3, 1), (3, 8), (3, 14), (4, 2), (4, 13),
(5, 6), (5, 17), (5, 21), (6, 3), (6, 12),
(7, 4), (7, 16), (7, 19), (8, 2), (8, 11),
(9, 9), (9, 10), (9, 22), (10, 5), (10, 14),
(11, 8), (11, 13), (11, 20), (12, 6), (12, 17),
(13, 1), (13, 4), (13, 19), (14, 3), (14, 12),
(15, 2), (15, 10), (15, 21), (16, 5), (16, 9),
(17, 7), (17, 14), (17, 18), (18, 8), (18, 11),
(19, 6), (19, 13), (19, 16), (20, 3), (20, 12),
(21, 4), (21, 15), (21, 19), (22, 2), (22, 18),
(23, 1), (23, 10), (23, 20), (24, 5), (24, 9),
(25, 7), (25, 16), (25, 22), (26, 6), (26, 13),
(27, 8), (27, 11), (27, 19), (28, 2), (28, 12),
(29, 4), (29, 15), (29, 20), (30, 1), (30, 9),
(31, 5), (31, 13), (31, 17), (32, 6), (32, 14),
(33, 7), (33, 10), (33, 21), (34, 3), (34, 19),
(35, 8), (35, 11), (35, 16), (36, 2), (36, 13),
(37, 4), (37, 12), (37, 20), (38, 1), (38, 9),
(39, 5), (39, 15), (39, 18), (40, 3), (40, 10),
(41, 6), (41, 14), (41, 21), (42, 7), (42, 13);

-- Continue with more data as needed

-- Insert data into the 'plant_locations' table
-- Example: Mango can grow in Maharashtra, Karnataka, Tamil Nadu, and Gujarat
INSERT INTO plant_locations (plant_id, location_id) VALUES
((SELECT id FROM plants WHERE plant_name = 'Mango'), (SELECT id FROM locations WHERE state_name = 'Maharashtra')),
((SELECT id FROM plants WHERE plant_name = 'Mango'), (SELECT id FROM locations WHERE state_name = 'Karnataka')),
((SELECT id FROM plants WHERE plant_name = 'Mango'), (SELECT id FROM locations WHERE state_name = 'Tamil Nadu')),
((SELECT id FROM plants WHERE plant_name = 'Mango'), (SELECT id FROM locations WHERE state_name = 'Gujarat')),

-- Example: Rice can grow in West Bengal, Assam, Bihar, and Odisha
((SELECT id FROM plants WHERE plant_name = 'Rice'), (SELECT id FROM locations WHERE state_name = 'West Bengal')),
((SELECT id FROM plants WHERE plant_name = 'Rice'), (SELECT id FROM locations WHERE state_name = 'Assam')),
((SELECT id FROM plants WHERE plant_name = 'Rice'), (SELECT id FROM locations WHERE state_name = 'Bihar')),
((SELECT id FROM plants WHERE plant_name = 'Rice'), (SELECT id FROM locations WHERE state_name = 'Odisha')),

-- Example: Coconut can grow in Kerala, Tamil Nadu, Karnataka, and Goa
((SELECT id FROM plants WHERE plant_name = 'Coconut'), (SELECT id FROM locations WHERE state_name = 'Kerala')),
((SELECT id FROM plants WHERE plant_name = 'Coconut'), (SELECT id FROM locations WHERE state_name = 'Tamil Nadu')),
((SELECT id FROM plants WHERE plant_name = 'Coconut'), (SELECT id FROM locations WHERE state_name = 'Karnataka')),
((SELECT id FROM plants WHERE plant_name = 'Coconut'), (SELECT id FROM locations WHERE state_name = 'Goa'));

-- Continue adding plant-state relationships for other plants.

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique user ID
    username VARCHAR(50) NOT NULL UNIQUE, -- Username (must be unique)
    email VARCHAR(100) NOT NULL UNIQUE,  -- Email address (must be unique)
    password VARCHAR(255) NOT NULL,      -- Hashed password for authentication
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Timestamp when the user was created
);