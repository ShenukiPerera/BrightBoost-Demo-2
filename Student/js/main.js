// Function to display error messages
function displayError(sectionId, message) {
    const section = document.getElementById(sectionId);
    section.innerHTML = `<p class="error-message">${message}</p>`;
}

// Fetch and display timetable data
document.getElementById('view-timetable-link').addEventListener('click', function(e) {
    e.preventDefault();

    fetch('php/view_timetable.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Display timetable data on the dashboard
        const timetableSection = document.getElementById('timetable-section');
        timetableSection.innerHTML = ''; // Clear previous content

        if (data && data.length > 0) {
            const table = document.createElement('table');
            table.innerHTML = `
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Tutor</th>
                    </tr>
                </thead>
                <tbody>
                ${data.map(session => `
                    <tr>
                        <td>${session.date}</td>
                        <td>${session.start_time}</td>
                        <td>${session.end_time}</td>
                        <td>${session.tutor}</td>
                    </tr>
                `).join('')}
                </tbody>
            `;
            timetableSection.appendChild(table);
        } else {
            timetableSection.textContent = 'No sessions found.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayError('timetable-section', 'Error fetching timetable data. Please try again later.');
    });
});




// Fetch and display the session queue
document.getElementById('join-queue-link').addEventListener('click', function(e) {
    e.preventDefault();

    fetch('php/join_queue.php', {
        method: 'POST',
        body: JSON.stringify({ action: 'join_queue' }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('queue-section').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
        displayError('queue-section', 'Error joining the queue. Please try again later.');
    });
});

// Fetch and display tutor expertise
document.getElementById('view-expertise-link').addEventListener('click', function(e) {
    e.preventDefault();

    fetch('php/view_expertise.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const expertiseSection = document.getElementById('expertise-section');
        expertiseSection.innerHTML = '';

        if (data && data.length > 0) {
            const ul = document.createElement('ul');
            ul.innerHTML = data.map(expertise => `<li>${expertise.subject} - ${expertise.tutor_name}</li>`).join('');
            expertiseSection.appendChild(ul);
        } else {
            expertiseSection.textContent = 'No tutor expertise available.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayError('expertise-section', 'Error fetching tutor expertise data. Please try again later.');
    });
});

// Fetch and display student statistics
document.getElementById('view-statistics-link').addEventListener('click', function(e) {
    e.preventDefault();

    fetch('php/view_statistics.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const statisticsSection = document.getElementById('statistics-section');
        statisticsSection.innerHTML = '';

        if (data && data.length > 0) {
            const ul = document.createElement('ul');
            ul.innerHTML = data.map(statistic => `<li>${statistic.stat_name}: ${statistic.value}</li>`).join('');
            statisticsSection.appendChild(ul);
        } else {
            statisticsSection.textContent = 'No statistics available.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayError('statistics-section', 'Error fetching student statistics. Please try again later.');
    });
});


/// Fetch and display the list of available learning materials
function listLearningMaterials() {
    fetch('php/access_materials.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const materialsSection = document.getElementById('materials-section');
        materialsSection.innerHTML = ''; // Clear previous content

        if (data && data.length > 0) {
            const ul = document.createElement('ul');
            data.forEach(material => {
                const li = document.createElement('li');
                const link = document.createElement('a');
                link.href = `php/access_materials.php?material=${encodeURIComponent(material)}`;
                link.textContent = material;
                li.appendChild(link);
                ul.appendChild(li);
            });
            materialsSection.appendChild(ul);
        } else {
            materialsSection.textContent = 'No learning materials available.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayError('materials-section', 'Error fetching learning materials. Please try again later.');
    });
}

// Add an event listener to the "Access Learning Materials" link
document.getElementById('access-materials-link').addEventListener('click', function(e) {
    e.preventDefault();
    listLearningMaterials();
});


