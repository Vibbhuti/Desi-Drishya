// Function to load external HTML components
function loadHTML(id, file) {
    fetch(file)
        .then(response => response.text())
        .then(data => {
            document.getElementById(id).innerHTML = data;
        })
        .catch(error => console.error(`Error loading ${file}:`, error));
}

// Load header and footer when DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    loadHTML("header", "Header.html");
    loadHTML("footer", "Footer.html");
});
