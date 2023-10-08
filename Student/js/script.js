// js/script.js

document.addEventListener("DOMContentLoaded", function () {
    // Function to hide all content sections
    function hideAllSections() {
        const sections = document.querySelectorAll(".section");
        sections.forEach((section) => {
            section.style.display = "none";
        });
    }

    // Function to show a specific content section by ID
    function showSection(sectionId) {
        hideAllSections();
        const section = document.getElementById(sectionId);
        if (section) {
            section.style.display = "block";
        }
    }

    // Add event listeners for menu items
    const menuItems = document.querySelectorAll("nav li a");
    menuItems.forEach((menuItem) => {
        menuItem.addEventListener("click", function (event) {
            event.preventDefault();
            const sectionId = menuItem.getAttribute("id").replace("menu-", "");
            showSection(sectionId);
        });
    });

    // Initial display: show the timetable section
    showSection("timetable");
});
