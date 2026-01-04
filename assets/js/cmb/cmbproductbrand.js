document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById("cmbproductbrand");

    // Exit gracefully if the element is not on this page
    if (!categorySelect) return;

    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/cmb/productbrand.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const categories = JSON.parse(xhr.responseText);
                    populateCategorySelect(categories);
                } catch (e) {
                    console.error("Error parsing brands JSON");
                }
            }
        };
        xhr.send();
    }

    function populateCategorySelect(categories) {
        categories.forEach((category) => {
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = category.brand;
            categorySelect.appendChild(option);
        });
    }

    loadCategories();
});