<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Teacher/teacher_style.css">
    <title>Student Specialities Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <section class="navigation">
        <nav class="navbar" role="navigation">
            <ul>
                <!-- admin activities -->
                <li><a href="teacheraccount.php">Teacher Account Creation</a></li>
                <li><a href="studentaccount.php">Student Account Creation</a></li>
                <li><a href="timetablecreation.php">Create Timetable</a></li>
                <!-- <li><a href="assigningteachers.php">Assign Teachers to Sessions</a></li> -->
                <li><a href="viewreports.php">View Analytics Reports</a></li>
                <li><a href="maintainuserdata.html">Maintain User Data</a></li>
            </ul>
        </nav>
    </section>
    <h1>Student Specialities Bar Chart</h1>

    <div>
        <canvas id="barChart" width="100px" height="40px"></canvas>
    </div>

    <script>
        var ctx = document.getElementById("barChart").getContext('2d');

        fetch('chart_data.php')
            .then(response => response.json())
            .then(data => {
                var labels = data.map(item => item.speciality);
                var values = data.map(item => item.student_count);

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Count of Students',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>
