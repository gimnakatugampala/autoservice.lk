document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("cmbvehicleowner");

    // Function to load categories using AJAX
    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/cmb/vehicleownerlist.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const categories = JSON.parse(xhr.responseText);
                populateCategorySelect(categories);
                // console.log(categories)
            }
        };
        xhr.send();
    }

    // Function to populate the select tab
    function populateCategorySelect(categories) {

        categories.forEach(function (category) {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = `${category.first_name} ${category.last_name}`;
            categorySelect.appendChild(option);
        });
    }

    loadCategories();
});