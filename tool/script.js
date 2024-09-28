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
            const plantInfo = document.getElementById("plant-info");

            // Check if the input is empty
            if (!plantName) {
                plantInfo.innerHTML = `<p style="color:red;">Please enter a plant name.</p>`;
                return;
            }

            // Send plant name to PHP using fetch
            fetch('get_plant_info.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `plant_name=${encodeURIComponent(plantName)}`
            })
            .then(response => response.text()) // Change to text if returning plain text
            .then(data => {
                plantInfo.innerHTML = `<h3>Plant Info for ${plantName.charAt(0).toUpperCase() + plantName.slice(1)}</h3>`;
                plantInfo.innerHTML += `<p>${data}</p>`; // Add plain text data to plant info
            })
            .catch(error => {
                console.error('Error:', error);
                plantInfo.innerHTML = `<p style="color:red;">An error occurred. Please try again.</p>`;
            });
        });
    }

    // Handle the "location-based-plant" option
    else if (selectedValue === "location-based-plant") {
        container.classList.add("expanded"); // Expand the container
        dynamicInput.innerHTML = `
            <label for="location">Select your location (State):</label><br><br>
            <select id="location" class="dropdown" required>
                <option value="">--Select State--</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Gujarat">Gujarat</option>
                <!-- Add more states as needed -->
            </select><br><br>
            <label for="avg-temp">Average Temperature (°C):</label><br><br>
            <input type="number" id="avg-temp" name="avg-temp" class="input-field" placeholder="e.g. 25" required><br><br>
            <label for="sunlight">Sunlight Exposure:</label><br><br>
            <select id="sunlight" class="dropdown" name="sunlight" required>
                <option value="">--Select Sunlight Exposure--</option>
                <option value="full sun">Full Sun</option>
                <option value="partial sun">Partial Sun</option>
                <option value="shade">Shade</option>
            </select><br><br>
            <label for="water-availability">Water Availability:</label><br><br>
            <select id="water-availability" class="dropdown" name="water-availability" required>
                <option value="">--Select Water Availability--</option>
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
            </select><br><br>
            <label for="humidity">Humidity Level:</label><br><br>
            <select id="humidity" class="dropdown" name="humidity" required>
                <option value="">--Select Humidity Level--</option>
                <option value="low">Low</option>
                <option value="moderate">Moderate</option>
                <option value="high">High</option>
            </select><br><br>
            <label for="soil-quality">Soil Quality:</label><br><br>
            <select id="soil-quality" class="dropdown" name="soil-quality" required>
                <option value="">--Select Soil Quality--</option>
                <option value="sandy">Sandy</option>
                <option value="loamy">Loamy</option>
                <option value="clay">Clay</option>
                <option value="silty">Silty</option>
            </select><br><br>
            <label for="soil-ph">Soil pH Level:</label><br><br>
            <input type="number" id="soil-ph" name="soil-ph" class="input-field" placeholder="Enter Soil pH" min="1" max="14" step="0.1" required>
            <br><br>
            <button type="button" id="check-location-info" class="submit-btn">Check Suitable Plants</button>
        `;

        // Add event listener for checking plant suitability
        document.getElementById("check-location-info").addEventListener("click", function () {
            const location = document.getElementById("location").value;
            const avgTemp = document.getElementById("avg-temp").value.trim();
            const sunlight = document.getElementById("sunlight").value;
            const waterAvailability = document.getElementById("water-availability").value;
            const humidity = document.getElementById("humidity").value;
            const soilQuality = document.getElementById("soil-quality").value;
            const soilPH = parseFloat(document.getElementById("soil-ph").value.trim());
            const plantInfo = document.getElementById("plant-info");

            // Validate inputs
            if (!location || !avgTemp || !sunlight || !waterAvailability || !humidity || !soilQuality || isNaN(soilPH)) {
                plantInfo.innerHTML = `<p style="color:red;">Please fill in all the fields.</p>`;
                return;
            }

            // Send location-based data to PHP using fetch
            // Update this section in your JavaScript code
            fetch('../get_suitable_plants.php', {
             method: 'POST',
              headers: {
                         'Content-Type': 'application/x-www-form-urlencoded',
                         },
                 body: `location=${encodeURIComponent(location)}&avg_temp=${encodeURIComponent(avgTemp)}&sunlight=${encodeURIComponent(sunlight)}&water_availability=${encodeURIComponent(waterAvailability)}&humidity=${encodeURIComponent(humidity)}&soil_quality=${encodeURIComponent(soilQuality)}&soil_ph=${encodeURIComponent(soilPH)}`
                })

            .then(response => response.text()) // Change to text if returning plain text or HTML
            .then(data => {
                plantInfo.innerHTML = `<h3>Recommended Plants for ${location}</h3>`;
                plantInfo.innerHTML += `<p>${data}</p>`; // Add plain text or HTML response to plant info
            })
            .catch(error => {
                console.error('Error:', error);
                plantInfo.innerHTML = `<p style="color:red;">An error occurred. Please try again.</p>`;
            });
        });
    }
});
