package com.yourcompany.plantingguide;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

import org.json.JSONObject;

public class TrefleClient {
    private final String apiToken;

    public TrefleClient(String apiToken) {
        if (apiToken == null || apiToken.isEmpty()) {
            throw new IllegalArgumentException("API token cannot be null or empty");
        }
        this.apiToken = apiToken;
    }

    public JSONObject getPlants(String query) throws IOException {
        if (query == null || query.isEmpty()) {
            throw new IllegalArgumentException("Query cannot be null or empty");
        }

        String endpoint = "https://trefle.io/api/v1/plants/search?token=" + apiToken + "&q=" + URLEncoder.encode(query, "UTF-8");
        URL url = new URL(endpoint);
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();
        connection.setRequestMethod("GET");

        int responseCode = connection.getResponseCode();
        if (responseCode != 200) {
            throw new IOException("Failed to retrieve plants: " + responseCode);
        }

        BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
        StringBuilder response = new StringBuilder();
        String line;
        while ((line = reader.readLine()) != null) {
            response.append(line);
        }
        reader.close();

        return new JSONObject(response.toString());
    }
}