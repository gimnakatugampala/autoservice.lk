document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("cmbpackageitems");
    const categorySelect2 = document.getElementById("cmbpackageitems2");


    // Function to load categories using AJAX
    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/cmb/packageitems.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const categories = JSON.parse(xhr.responseText);
                populateCategorySelect(categories);
                populateCategorySelect2(categories)
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
            option.textContent = category.name;
            categorySelect.appendChild(option);
    
        });
    }

    function populateCategorySelect2(categories) {

        categories.forEach(function (category) {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = category.name;
            categorySelect2.appendChild(option);
    
        });
    }

    loadCategories();
});