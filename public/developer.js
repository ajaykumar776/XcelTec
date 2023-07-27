function fetchStates(id, countryId) {
    $.ajax({
        url: `/api/getStates/${countryId}`,
        method: 'GET',
        success: function (response) {
            response = response.states;
            const stateDropdown = $('#state_' + id);
            console.log()
            stateDropdown.empty().prop('disabled', false);
            stateDropdown.append('<option value="">Select State</option>');
            const stateOptions = response.map(state => `<option value="${state.id}">${state.name}</option>`);
            stateDropdown.append(stateOptions);
        },
        error: function (error) {
            console.error('Error fetching states:', error);
        }
    });
}



// Function to fetch cities based on selected state
function fetchCities(id, stateId) {
    $.ajax({
        url: `/api/getCities/${stateId}`, // Replace with the actual URL for fetching cities
        method: 'GET',
        success: function (response) {
            response = response.cities;
            const cityDropdown = $('#city_' + id);
            cityDropdown.empty().prop('disabled', false);
            cityDropdown.append('<option value="">Select City</option>');
            response.forEach(city => {
                cityDropdown.append(`<option value="${city.id}">${city.name}</option>`);
            });
        },
        error: function (error) {
            console.error('Error fetching cities:', error);
        }
    });
}

// Event handler for country selection
function loadState(id, value) {
    var id = id.split("_")[1];
    if (value) {
        fetchStates(id, value);
    }
}

// Event handler for state selection
function loadCity(id, value) {
    var id = id.split("_")[1];
    if (value) {
        fetchCities(id, value);
    }
}