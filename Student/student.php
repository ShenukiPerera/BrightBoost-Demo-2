<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Boost Student Interface</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Welcome, Student!</h1>
    </header>

    <!-- Menu Section -->
    <nav>
        <ul>
            <li><a href="#" id="menu-timetable">Timetable</a></li>
            <li><a href="#" id="menu-queue">Join Queue and Ask Questions</a></li>
            <li><a href="#" id="menu-tutor">Tutor's Expertise</a></li>
            <li><a href="#" id="menu-statistics">Statistics</a></li>
            <li><a href="#" id="menu-materials">Learning Materials</a></li>
        </ul>
    </nav>

    <!-- Content Sections -->
    <div id="timetable" class="section" style="display: none;">
        <h2>Timetable</h2>
        <!-- Timetable content will be loaded here using PHP -->
        <?php include 'timetable.php'; ?>
    </div>

    <div id="queue" class="section" style="display: none;">
        <h2>Join Queue and Ask Questions</h2>
        <!-- Queue content will be loaded here using PHP -->
        <?php include 'queue.php'; ?>
    </div>

    <div id="tutor" class="section" style="display: none;">
        <h2>Tutor's Expertise</h2>
        <!-- Tutor expertise content will be loaded here using PHP -->
        <?php include 'tutor_expertise.php'; ?>
    </div>

    <div id="statistics" class="section" style="display: none;">
        <h2>Statistics</h2>
        <!-- Student statistics will be loaded here using PHP -->
        <?php include 'statistics.php'; ?>
    </div>
    
   <div id="materials" class="section" style="display: none;">
        <h2>Learning Materials</h2>
        <!-- Learning materials content will be loaded here using PHP -->
        <?php include 'learning_materials.php'; ?>
    </div>
   
    <!-- Logout Button -->
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>

    <script src="js/script.js"></script>
</body>
</html>
