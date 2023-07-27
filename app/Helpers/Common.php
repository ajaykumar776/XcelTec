<?php


namespace App\Helpers;

class Common
{
    // Function to get a list of states for a given country
    public static function getCities($state_id = null)
    {
        $cities = [
            // Cities in Andhra Pradesh
            ['id' => 1, 'name' => 'Visakhapatnam', 'state_id' => 1],
            ['id' => 2, 'name' => 'Vijayawada', 'state_id' => 1],
            ['id' => 3, 'name' => 'Guntur', 'state_id' => 1],
            ['id' => 4, 'name' => 'Tirupati', 'state_id' => 1],
            ['id' => 5, 'name' => 'Kakinada', 'state_id' => 1],
            // Add more cities in Andhra Pradesh here

            // Cities in Arunachal Pradesh
            ['id' => 6, 'name' => 'Itanagar', 'state_id' => 2],
            ['id' => 7, 'name' => 'Naharlagun', 'state_id' => 2],
            ['id' => 8, 'name' => 'Tawang', 'state_id' => 2],
            ['id' => 9, 'name' => 'Pasighat', 'state_id' => 2],
            ['id' => 10, 'name' => 'Ziro', 'state_id' => 2],
            // Add more cities in Arunachal Pradesh here

            // Cities in Assam
            ['id' => 11, 'name' => 'Guwahati', 'state_id' => 3],
            ['id' => 12, 'name' => 'Dibrugarh', 'state_id' => 3],
            ['id' => 13, 'name' => 'Silchar', 'state_id' => 3],
            ['id' => 14, 'name' => 'Tezpur', 'state_id' => 3],
            ['id' => 15, 'name' => 'Jorhat', 'state_id' => 3],

            // Cities for Karnataka, India (State ID: 1)
            ['id' => 11, 'name' => 'Mysuru', 'state_id' => 1], // Mysuru, Karnataka, India
            ['id' => 12, 'name' => 'Mangaluru', 'state_id' => 1], // Mangaluru, Karnataka, India
            ['id' => 13, 'name' => 'Hubballi', 'state_id' => 1], // Hubballi, Karnataka, India
            ['id' => 14, 'name' => 'Belagavi', 'state_id' => 1], // Belagavi, Karnataka, India
            ['id' => 15, 'name' => 'Ballari', 'state_id' => 1], // Ballari, Karnataka, India

            // Cities for California, USA (State ID: 2)
            ['id' => 16, 'name' => 'Los Angeles', 'state_id' => 2], // Los Angeles, California, USA
            ['id' => 17, 'name' => 'San Diego', 'state_id' => 2], // San Diego, California, USA
            ['id' => 18, 'name' => 'San Jose', 'state_id' => 2], // San Jose, California, USA
            ['id' => 19, 'name' => 'Fresno', 'state_id' => 2], // Fresno, California, USA
            ['id' => 20, 'name' => 'Sacramento', 'state_id' => 2], // Sacramento, California, USA

            // Cities for Ontario, Canada (State ID: 4)
            ['id' => 21, 'name' => 'Ottawa', 'state_id' => 4], // Ottawa, Ontario, Canada
            ['id' => 22, 'name' => 'Hamilton', 'state_id' => 4], // Hamilton, Ontario, Canada
            ['id' => 23, 'name' => 'Kitchener', 'state_id' => 4], // Kitchener, Ontario, Canada
            ['id' => 24, 'name' => 'London', 'state_id' => 4], // London, Ontario, Canada
            ['id' => 25, 'name' => 'Windsor', 'state_id' => 4], // Windsor, Ontario, Canada
            // jharkhand 
            ['id' => 29, 'name' => 'Ranchi', 'state_id' => 12],
            ['id' => 30, 'name' => 'Jamshedpur', 'state_id' => 12],
            ['id' => 31, 'name' => 'Dhanbad', 'state_id' => 12],
            ['id' => 32, 'name' => 'Bokaro', 'state_id' => 12],
            ['id' => 33, 'name' => 'Hazaribagh', 'state_id' => 12],

            // Cities in Gujarat
            ['id' => 34, 'name' => 'Ahmedabad', 'state_id' => 14],
            ['id' => 35, 'name' => 'Surat', 'state_id' => 14],
            ['id' => 36, 'name' => 'Vadodara', 'state_id' => 14],
            ['id' => 37, 'name' => 'Rajkot', 'state_id' => 14],
            ['id' => 38, 'name' => 'Gandhinagar', 'state_id' => 14],
        ];

        if ($state_id) {
            $filteredcities = array_filter($cities, function ($state) use ($state_id) {
                return $state['state_id'] == $state_id;
            });
            return  array_values($filteredcities);
        }
        return $cities;
    }

    // Function to get a list of cities for a given state
    public static function getStates($country_id = null)
    {

        $states = [
            ['id' => 1, 'name' => 'Karnataka', 'country_id' => 1], // Karnataka, India
            ['id' => 2, 'name' => 'California', 'country_id' => 2], // California, USA
            ['id' => 3, 'name' => 'London', 'country_id' => 3], // London, UK
            ['id' => 4, 'name' => 'Ontario', 'country_id' => 4], // Ontario, Canada
            ['id' => 5, 'name' => 'New South Wales', 'country_id' => 5], // New South Wales, Australia
            ['id' => 6, 'name' => 'Berlin', 'country_id' => 6], // Berlin, Germany
            ['id' => 7, 'name' => 'Paris', 'country_id' => 7], // Paris, France
            ['id' => 8, 'name' => 'São Paulo', 'country_id' => 8], // São Paulo, Brazil
            ['id' => 9, 'name' => 'Tokyo', 'country_id' => 9], // Tokyo, Japan
            ['id' => 10, 'name' => 'Beijing', 'country_id' => 10], // Beijing, China

            // States for India (Country ID: 1)
            ['id' => 11, 'name' => 'Maharashtra', 'country_id' => 1], // Maharashtra, India
            ['id' => 12, 'name' => 'Tamil Nadu', 'country_id' => 1], // Tamil Nadu, India
            ['id' => 13, 'name' => 'Uttar Pradesh', 'country_id' => 1], // Uttar Pradesh, India
            ['id' => 14, 'name' => 'Gujarat', 'country_id' => 1], // Gujarat, India
            ['id' => 15, 'name' => 'Rajasthan', 'country_id' => 1], // Rajasthan, India

            // States for the United States (Country ID: 2)
            ['id' => 16, 'name' => 'New York', 'country_id' => 2], // New York, USA
            ['id' => 17, 'name' => 'Texas', 'country_id' => 2], // Texas, USA
            ['id' => 18, 'name' => 'Florida', 'country_id' => 2], // Florida, USA
            ['id' => 19, 'name' => 'California', 'country_id' => 2], // California, USA
            ['id' => 20, 'name' => 'Illinois', 'country_id' => 2], // Illinois, USA

            // States for Canada (Country ID: 4)
            ['id' => 21, 'name' => 'Ontario', 'country_id' => 4], // Ontario, Canada
            ['id' => 22, 'name' => 'Quebec', 'country_id' => 4], // Quebec, Canada
            ['id' => 23, 'name' => 'British Columbia', 'country_id' => 4], // British Columbia, Canada
            ['id' => 24, 'name' => 'Alberta', 'country_id' => 4], // Alberta, Canada
            ['id' => 25, 'name' => 'Manitoba', 'country_id' => 4], // Manitoba, Canada
        ];

        if ($country_id) {

            $filteredStates = array_filter($states, function ($state) use ($country_id) {
                return $state['country_id'] == $country_id;
            });
            $filteredStates = array_values($filteredStates);
            return $filteredStates;
        }

        return $states;
    }

    // Function to get a list of all countries
    public static function getAllCountries()
    {
        return [
            ['id' => 1, 'name' => 'India'],
            ['id' => 2, 'name' => 'United States'],
            ['id' => 3, 'name' => 'United Kingdom'],
            ['id' => 4, 'name' => 'Canada'],
            ['id' => 5, 'name' => 'Australia'],
            ['id' => 6, 'name' => 'Germany'],
            ['id' => 7, 'name' => 'France'],
            ['id' => 8, 'name' => 'Brazil'],
            ['id' => 9, 'name' => 'Japan'],
            ['id' => 10, 'name' => 'China'],
        ];
    }
}
