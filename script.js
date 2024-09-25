document.getElementById("plant-type").addEventListener("change", function () {
    const dynamicInput = document.getElementById("dynamic-input");
    dynamicInput.innerHTML = ""; // Clear previous content
    const plantInfo = document.getElementById("plant-info");
    plantInfo.innerHTML = ""; // Clear previous plant info

    const selectedValue = this.value;
    const container = document.querySelector(".container");

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

            // Mock plant data for demonstration purposes
            const plantData = {
                "rose": { weather: "Sunny", soil: "Loamy" },
                "tulip": { weather: "Cool", soil: "Well-drained" },
                "cactus": { weather: "Dry", soil: "Sandy" }
            };

            if (plantData[plantName]) {
                plantInfo.innerHTML = `
                    <h3>Recommended Growing Conditions for ${plantName.charAt(0).toUpperCase() + plantName.slice(1)}</h3>
                    <p><strong>Weather Condition:</strong> ${plantData[plantName].weather}</p>
                    <p><strong>Soil Type:</strong> ${plantData[plantName].soil}</p>
                `;
            } else {
                plantInfo.innerHTML = `<p style="color:red;">Sorry, we don't have information for the plant "${plantName}".</p>`;
            }
        });
    } else if (selectedValue === "location-based-plant") {
        container.classList.add("expanded"); // Expand the container
        dynamicInput.innerHTML = `
            <label for="location">Enter your location:</label><br><br>
            <input type="text" id="location" name="location" class="input-field" placeholder="e.g. California, Florida" required><br><br>
            <label for="avg-temp">Average Temperature (°C):</label><br><br>
            <input type="number" id="avg-temp" name="avg-temp" class="input-field" placeholder="e.g. 25" required><br><br>
            <label for="sunlight">Sunlight Exposure:</label><br><br>
            <select id="sunlight" class="dropdown" name="sunlight" required>
                <option value="">--Select Sunlight Exposure--</option>
                <option value="full-sun">Full Sun</option>
                <option value="partial-sun">Partial Sun</option>
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
            <span class="help-text"><a href="https://www.youtube.com/watch?v=xyz" target="_blank">Need help with pH?</a></span>
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
            const soilPH = document.getElementById("soil-ph").value.trim();
            const plantInfo = document.getElementById("plant-info");

            // Validate inputs
            if (!location || !avgTemp || !sunlight || !humidity || !soilColor || !soilPH) {
                plantInfo.innerHTML = `<p style="color:red;">Please fill in all the fields.</p>`;
                return;
            }

            // Mock plant suitability logic for demonstration purposes
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
                <p>Suggested Plants: <strong>Sunflower, Zinnia, Marigold</strong></p>
            `;
        });
    }
});
