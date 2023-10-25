<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Specialities Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="teacher_style.css">
</head>
<body>
    <h1>Student Specialities Bar Chart</h1>

    <div>
        <canvas id="barChart" width="400" height="200"></canvas>
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
