document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("cmbsearchvehicles");

    // Function to load categories using AJAX
    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/cmb/searchvehicles.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const categories = JSON.parse(xhr.responseText);
                populateVehiclesSearchSelect(categories);
                // console.log(categories)
            }
        };
        xhr.send();
    }

    // Function to populate the select tab
    function populateVehiclesSearchSelect(categories) {

        categories.forEach(function (category) {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = `${category.vehicle_number}`;
            categorySelect.appendChild(option);
        });
    }

    loadCategories();
});