document.addEventListener("DOMContentLoaded", function () {
    const UserElement = document.getElementById("logged-in-user");

    // Function to load categories using AJAX
    function loadCategories() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../api/getuserdata.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const categories = JSON.parse(xhr.responseText);
                populateCategorySelect(categories[0]);
                console.log(categories)
            }
        };
        xhr.send();
    }

    // Function to populate the select tab
    function populateCategorySelect(categories) {

        if(categories.first_name == null || categories.last_name == null){
            UserElement.textContent = "Admin"
        }else{
            UserElement.textContent = `${categories.first_name} ${categories.last_name}`
        }


    }

    loadCategories();
});