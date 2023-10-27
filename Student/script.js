
document.addEventListener('DOMContentLoaded', function () {
    // Get menu item elements by ID
    var timetableLink = document.getElementById('view-timetable-link');
    var joinQueueLink = document.getElementById('join-queue-link');
    var expertiseLink = document.getElementById('view-expertise-link');
 
    var materialsLink = document.getElementById('access-materials-link');

    // Get content sections by ID
    var timetableSection = document.getElementById('timetable-section');
    var queueSection = document.getElementById('queue-section');
    var expertiseSection = document.getElementById('expertise-section');

    var materialsSection = document.getElementById('materials-section');

    // Event listeners for menu item clicks
    timetableLink.addEventListener('click', function (event) {
        event.preventDefault();
        hideAllSections();
        timetableSection.style.display = 'block';

   // Use an AJAX request to load timetable data from view_timetable.php
   var xhr = new XMLHttpRequest();
   xhr.open('GET', 'view_timetable.php', true);

   xhr.onload = function () {
       if (xhr.status >= 200 && xhr.status < 300) {
           // Log the response for debugging
           console.log(xhr.responseText);

           // Insert the response into the timetable content
           timetableSection.innerHTML = xhr.responseText;
       } else {
           // Handle errors
           console.error('Error loading timetable data.');
       }
   };

   xhr.send();

    });

    joinQueueLink.addEventListener('click', function (event) {
        event.preventDefault();
        hideAllSections();
        queueSection.style.display = 'block';
    
        // Use an AJAX request to load queue data from join_queue.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'join_queue.php', true);
    
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Log the response for debugging
                console.log(xhr.responseText);
    
                // Insert the response into the queue section
                queueSection.innerHTML = xhr.responseText;
            } else {
                // Handle errors
                console.error('Error loading queue data.');
            }
        };
    
        xhr.send();
    });

    expertiseLink.addEventListener('click', function (event) {
        event.preventDefault();
        hideAllSections();
        expertiseSection.style.display = 'block';
    
        // Use an AJAX request to load expertise data from view_expertise.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'view_expertise.php', true);
    
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Log the response for debugging
                console.log(xhr.responseText);
    
                // Insert the response into the expertise section
                expertiseSection.innerHTML = xhr.responseText;
            } else {
                // Handle errors
                console.error('Error loading expertise data.');
            }
        };
    
        xhr.send();
    });
    


    materialsLink.addEventListener('click', function (event) {
        event.preventDefault();
        hideAllSections();
        materialsSection.style.display = 'block';
    
        // Use an AJAX request to load materials data from access_materials.php
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'access_materials.php', true);
    
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Log the response for debugging
                console.log(xhr.responseText);
    
                // Insert the response into the materials section
                materialsSection.innerHTML = xhr.responseText;
            } else {
                // Handle errors
                console.error('Error loading materials data.');
            }
        };
    
        xhr.send();
    });
    

    // Helper function to hide all content sections
    function hideAllSections() {
        timetableSection.style.display = 'none';
        queueSection.style.display = 'none';
        expertiseSection.style.display = 'none';
        materialsSection.style.display = 'none';
    }
});
