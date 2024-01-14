<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>PC Info Viewer</title>
</head>
<body>
    <?php
    // Function to download the log file
    function download_log_file($pcInfoFile) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($pcInfoFile));
        readfile($pcInfoFile);
    }

    // Function to delete the log file
    function delete_log_file($pcInfoFile) {
        if (file_exists($pcInfoFile)) {
            unlink($pcInfoFile);
        }
    }

    // Function to get the previous URL
    function get_previous_url() {
        return $_SERVER['HTTP_REFERER'];
    }

    // Initialize $pcInfoFile
    $pcInfoFile = "";

    // Handle Reset and Download Buttons
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reset'])) {
            // Handle Reset button action
            // Define $pcInfoFile based on the selected PC
            if (isset($_GET['pc'])) {
                $selectedPC = $_GET['pc'];
                $pcInfoFile = "pc_info/{$selectedPC}_info.txt";
                // Delete the log file
                delete_log_file($pcInfoFile);
            }
            // Redirect back to the previous page
            header('Location: ' . get_previous_url());
            exit();
        }
    }
    ?>

    <button onclick="<?php echo 'download_log_file("' . $pcInfoFile . '")'; ?>">Download</button>

    <form method="post" action="">
        <button type="submit" name="reset">Reset</button>
    </form>

    <button onclick="window.location.href='<?php echo get_previous_url(); ?>'">Back</button>

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
