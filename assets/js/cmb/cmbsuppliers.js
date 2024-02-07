document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("cmbsuppliers");

    // Function to load categories using AJAX
    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/cmb/suppliers.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const categories = JSON.parse(xhr.responseText);
                populateSupplierSelect(categories);
                // console.log(categories)
            }
        };
        xhr.send();
    }

    // Function to populate the select tab
    function populateSupplierSelect(categories) {

        categories.forEach(function (category) {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = `${category.first_name} ${category.last_name}`;
            categorySelect.appendChild(option);
        });
    }

    loadCategories();
});