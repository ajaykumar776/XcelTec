function fetchStates(countryId) {
    $.ajax({
        url: `/api/getStates/${countryId}`,
        method: 'GET',
        success: function (response) {
            response = response.states;
            const stateDropdown = $('#state');
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
function fetchCities(stateId) {
    $.ajax({
        url: `/api/getCities/${stateId}`, // Replace with the actual URL for fetching cities
        method: 'GET',
        success: function (response) {
            response = response.cities;
            const cityDropdown = $('#city');
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

let country = $('#country').val()
if (country) {
    fetchStates(country);
}
// Event handler for country selection
$('#country').on('change', function () {
    const selectedCountryId = $(this).val();
    $('#state').empty().prop('disabled', true);
    $('#city').empty().prop('disabled', true);
    if (selectedCountryId) {
        fetchStates(selectedCountryId);
    }
});

// Event handler for state selection
$('#state').on('change', function () {
    const selectedStateId = $(this).val();
    $('#city').empty().prop('disabled', true);
    if (selectedStateId) {
        fetchCities(selectedStateId);
    }
});
