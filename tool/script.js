document.getElementById("plant-type").addEventListener("change", function () {
    const dynamicInput = document.getElementById("dynamic-input");
    dynamicInput.innerHTML = ""; // Clear previous content
    const plantInfo = document.getElementById("plant-info");
    plantInfo.innerHTML = ""; // Clear previous plant info

    const selectedValue = this.value;
    const container = document.querySelector(".container");

    // Handle the "particular-plant" option
    if (selectedValue === "particular-plant") {
        container.classList.add("expanded"); // Expand the container
        dynamicInput.innerHTML = `
            <label for="plant-name">Enter the name of the plant:</label><br><br>
            <input type="text" id="plant-name" name="plant-name" class="input-field" placeholder="e.g. Rose, Tulip" required><br><br>
            <button type="button" id="check-plant-info" class="submit-btn">Check Plant Info</button>
        `;

        // Add event listener for the new button
        document.getElementById("check-plant-info").addEventListener("click", function () {
            const plantName = document.getElementById("plant-name").value.trim().toLowerCase();
            
            // Check if the input is empty
            if (!plantName) {
                plantInfo.innerHTML = `<p style="color:red;">Please enter a plant name.</p>`;
                return;
            }

            // AJAX request to get plant data from the PHP backend
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "get_plant_info.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        plantInfo.innerHTML = `
                            <h3>Recommended Growing Conditions for ${response.data.name}</h3>
                            <p><strong>Weather Condition:</strong> ${response.data.weather}</p>
                            <p><strong>Soil Type:</strong> ${response.data.soil}</p>
                        `;
                    } else {
                        plantInfo.innerHTML = `<p style="color:red;">${response.message}</p>`;
                    }
                }
            };
            xhr.send("plant_name=" + encodeURIComponent(plantName));
        });
    }

    // Handle the "location-based-plant" option
    else if (selectedValue === "location-based-plant") {
        container.classList.add("expanded"); // Expand the container
        dynamicInput.innerHTML = `
            <label for="location">Enter your location:</label><br><br>
            <input type="text" id="location" name="location" class="input-field" placeholder="e.g. Mumbai, Pune" required><br><br>
            <label for="avg-temp">Average Temperature (°C):</label><br><br>
            <input type="number" id="avg-temp" name="avg-temp" class="input-field" placeholder="e.g. 25" required><br><br>
            <label for="sunlight">Sunlight Exposure:</label><br><br>
            <select id="sunlight" class="dropdown" name="sunlight" required>
                <option value="">--Select Sunlight Exposure--</option>
                <option value="full sun">Full Sun</option>
                <option value="partial sun">Partial Sun</option>
                <option value="shade">Shade</option>
            </select><br><br>
            <label for="humidity">Humidity Level:</label><br><br>
            <select id="humidity" class="dropdown" name="humidity" required>
                <option value="">--Select Humidity Level--</option>
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
            </select><br><br>
            <label for="soil-color">Color of Soil:</label><br><br>
            <select id="soil-color" class="dropdown" name="soil-color" required>
                <option value="">--Select Soil Color--</option>
                <option value="dark">Dark</option>
                <option value="light">Light</option>
                <option value="red">Red</option>
                <option value="yellow">Yellow</option>
            </select><br><br>
            <label for="soil-ph">Soil pH Level:</label><br><br>
            <input type="number" id="soil-ph" name="soil-ph" class="input-field" placeholder="Enter Soil pH" min="1" max="14" step="0.1" required>
            <span class="help-text"><a href="https://youtu.be/ejHvUnzMFoI" target="_blank">Need help with pH?</a></span>
            <br><br>
            <button type="button" id="check-location-info" class="submit-btn">Check Suitable Plants</button>
        `;

        // Add event listener for checking plant suitability
        document.getElementById("check-location-info").addEventListener("click", function () {
            const location = document.getElementById("location").value.trim();
            const avgTemp = document.getElementById("avg-temp").value.trim();
            const sunlight = document.getElementById("sunlight").value;
            const humidity = document.getElementById("humidity").value;
            const soilColor = document.getElementById("soil-color").value;
            const soilPH = parseFloat(document.getElementById("soil-ph").value.trim());

            // Validate inputs
            if (!location || !avgTemp || !sunlight || !humidity || !soilColor || isNaN(soilPH)) {
                plantInfo.innerHTML = `<p style="color:red;">Please fill in all the fields.</p>`;
                return;
            }

            // AJAX request to check plant suitability
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "get_location_plants.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        plantInfo.innerHTML = `
                            <h3>Recommended Plants for ${location}</h3>
                            <p>Based on the provided conditions:</p>
                            <ul>
                                <li>Temperature: ${avgTemp}°C</li>
                                <li>Sunlight: ${sunlight}</li>
                                <li>Humidity: ${humidity}</li>
                                <li>Soil Color: ${soilColor}</li>
                                <li>Soil pH: ${soilPH}</li>
                            </ul>
                            <p>Suggested Plants: <strong>${response.plants.join(", ")}</strong></p>
                        `;
                    } else {
                        plantInfo.innerHTML = `<p style="color:red;">${response.message}</p>`;
                    }
                }
            };
            xhr.send(`location=${encodeURIComponent(location)}&avg_temp=${encodeURIComponent(avgTemp)}&sunlight=${encodeURIComponent(sunlight)}&humidity=${encodeURIComponent(humidity)}&soil_color=${encodeURIComponent(soilColor)}&soil_ph=${soilPH}`);
        });
    }
});
