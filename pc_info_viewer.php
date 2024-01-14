<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>PC Info Viewer</title>
</head>
<body>
    <h2>PC Info Viewer</h2>
    <?php
    // Add code here to dynamically generate links to individual PC Info pages
    $pcInfoDir = 'pc_info/';
    $pcInfoFiles = glob($pcInfoDir . '*_info.txt');

    if ($pcInfoFiles) {
        echo '<ul>';
        foreach ($pcInfoFiles as $pcInfoFile) {
            $computerName = str_replace('_info.txt', '', basename($pcInfoFile));
            echo "<li><a href='pc_info_viewer.php?pc={$computerName}'>{$computerName}</a></li>";
        }
        echo '</ul>';
    } else {
        echo '<p>No PC Info available.</p>';
    }

    // Add code here to display the content of the selected PC Info
    if (isset($_GET['pc'])) {
        $selectedPC = $_GET['pc'];
        $pcInfoFile = "pc_info/{$selectedPC}_info.txt";

        if (file_exists($pcInfoFile)) {
            $pcInfoContent = file_get_contents($pcInfoFile);

            // Display formatted PC Info content
            echo "<div>$pcInfoContent</div>";
        } else {
            echo "<p>No PC Info available for $selectedPC.</p>";
        }
    } else {
        echo "<p>No PC selected.</p>";
    }
    ?>
</body>
</html>
