<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>PC Log Viewer</title>
</head>
<body>
    <h2>PC Log Viewer</h2>
    <?php
    // Add code here to dynamically generate links to individual PC logs
    $pcLogsDir = 'pc_logs/';
    $pcLogs = glob($pcLogsDir . '*_log.txt');

    if ($pcLogs) {
        echo '<ul>';
        foreach ($pcLogs as $pcLog) {
            $computerName = str_replace('_log.txt', '', basename($pcLog));
            echo "<li><a href='pc_log_viewer.php?pc={$computerName}'>{$computerName}</a></li>";
        }
        echo '</ul>';
    } else {
        echo '<p>No PC logs available.</p>';
    }
    ?>
</body>
</html>
