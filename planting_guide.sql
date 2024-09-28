-- Create the database
CREATE DATABASE planting_guide;

-- Use the planting_guide database
USE planting_guide;

-- Table for storing plant information
CREATE TABLE plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    scientific_name VARCHAR(255),
    sunlight_requirement VARCHAR(100),
    soil_quality VARCHAR(100),
    temperature_min DECIMAL(5, 2), -- Minimum temperature for growing in °C
    temperature_max DECIMAL(5, 2), -- Maximum temperature for growing in °C
    humidity_level VARCHAR(50), -- Humidity requirement (low, moderate, high)
    soil_ph_min DECIMAL(3, 1), -- Minimum soil pH value
    soil_ph_max DECIMAL(3, 1) -- Maximum soil pH value
);

-- Table for storing location-specific plant recommendations
CREATE TABLE location_based_plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255) NOT NULL, -- User's location (city or region)
    avg_temperature DECIMAL(5, 2) NOT NULL, -- Average temperature in °C
    sunlight VARCHAR(50) NOT NULL, -- Sunlight exposure (full sun, partial sun, shade)
    humidity VARCHAR(50) NOT NULL, -- Humidity level (low, moderate, high)
    soil_color VARCHAR(50) NOT NULL, -- Soil color (dark, light, red, yellow)
    soil_ph DECIMAL(3, 1) NOT NULL -- Soil pH value
);

-- Table for associating location-based conditions with plant recommendations
CREATE TABLE recommended_plants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT NOT NULL, -- Reference to the location-based condition
    plant_id INT NOT NULL, -- Reference to the plant
    FOREIGN KEY (location_id) REFERENCES location_based_plants(id),
    FOREIGN KEY (plant_id) REFERENCES plants(id)
);

-- Sample Data Insertion (Optional)

-- Inserting some sample plants
INSERT INTO plants (name, scientific_name, sunlight_requirement, soil_quality, temperature_min, temperature_max, humidity_level, soil_ph_min, soil_ph_max)
VALUES
('Rose', 'Rosa', 'full sun', 'well-drained', 16.0, 32.0, 'moderate', 6.0, 7.5),
('Tulip', 'Tulipa', 'partial sun', 'well-drained', 10.0, 20.0, 'low', 6.5, 7.5),
('Lavender', 'Lavandula', 'full sun', 'sandy', 18.0, 30.0, 'low', 6.0, 8.0),
('Basil', 'Ocimum basilicum', 'partial sun', 'moist', 18.0, 28.0, 'moderate', 5.5, 6.5);

-- Inserting some sample location-based conditions
INSERT INTO location_based_plants (location, avg_temperature, sunlight, humidity, soil_color, soil_ph)
VALUES
('Mumbai', 30.0, 'full sun', 'high', 'dark', 6.5),
('Pune', 25.0, 'partial sun', 'moderate', 'light', 7.0);

-- Associating plants with the location-based conditions
INSERT INTO recommended_plants (location_id, plant_id)
VALUES
(1, 1), -- Mumbai -> Rose
(1, 4), -- Mumbai -> Basil
(2, 2), -- Pune -> Tulip
(2, 3); -- Pune -> Lavender
