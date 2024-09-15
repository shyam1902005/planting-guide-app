package com.yourcompany.plantingguide;

import org.json.JSONObject;

public class Main {
    public static void main(String[] args) {
        String apiToken = "miUd_Fx7ThXn36lOXzN6srIQaZy7HzWikGYcZMxeGCo"; // Replace with your actual API token
        TrefleClient client = new TrefleClient(apiToken);

        try {
            // Fetch plant information for "rose"
            JSONObject response = client.getPlants("rose");
            System.out.println("Response from Trefle API: " + response.toString(4));
        } catch (Exception e) {
            System.out.println("Error fetching plants: " + e.getMessage());
            e.printStackTrace();
        }
    }
}