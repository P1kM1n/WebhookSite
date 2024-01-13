<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Webhook Viewer</title>
</head>
<body>
    <h2>Webhook Viewer</h2>

        <!-- Search Form -->
        <form action="" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter keyword">
            <button type="submit">Search</button>
        </form>

        <!-- Date Filtering Form -->
        <form action="" method="get">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate">
            <button type="submit">Filter by Date</button>
        </form>

        <!-- Reset Log Form -->
        <form action="reset.php" method="post">
            <button type="submit">Reset Log</button>
        </form>

        <!-- Download Log Button -->
        <form action="download.php" method="get">
            <button type="submit">Download Log</button>
        </form>

            <!-- Display Log Entries with Navigation Buttons -->
        <pre>
            <?php
            $logContent = file_get_contents(__DIR__ . '/webhook.log');
            $logEntries = explode("------------------------", $logContent);
            $totalEntries = count($logEntries);
            $currentEntry = isset($_GET['entry']) ? intval($_GET['entry']) : 0;

            // Ensure the current entry is within bounds
            $currentEntry = max(0, min($currentEntry, $totalEntries - 1));

            // Display the current log entry
            echo $logEntries[$currentEntry];

            // Display Navigation Buttons with Numbers
            if ($totalEntries > 1) {
                echo '<div class="navigation-buttons">';
                if ($currentEntry > 0) {
                    echo '<a href="?entry=' . ($currentEntry - 1) . '">&#9664; Previous</a>';
                }

                // Display entry numbers between Previous and Next buttons
                echo '<span class="entry-number">' . ($currentEntry + 1) . '/' . $totalEntries . '</span>';

                if ($currentEntry < $totalEntries - 1) {
                    echo '<a href="?entry=' . ($currentEntry + 1) . '">Next &#9654;</a>';
                }
                echo '</div>';
            }
            ?>
        </pre>

    </div>
</body>
</html>

<?php
function performSearch($logContent, $searchKeyword) {
    $lines = explode("\n", $logContent);
    $found = false;

    foreach ($lines as $line) {
        if (stripos($line, $searchKeyword) !== false) {
            $found = true;
            break;
        }
    }

    if ($found) {
        // Scroll to the first found match
        echo "<script>window.onload = function() { document.body.scrollTop = document.documentElement.scrollTop = document.querySelector('mark').offsetTop; }</script>";
    }

    return preg_replace("/($searchKeyword)/i", '<mark>$1</mark>', $logContent);
}

function filterLogByDate($logContent, $startDate, $endDate) {
    $lines = explode("\n", $logContent);
    $filteredLines = [];
    $foundTimestamp = false;

    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }

        $timestampMatch = preg_match("/Timestamp: (\S+)/", $line, $matches);
        if ($timestampMatch) {
            $timestamp = $matches[1];
            if (($startDate === null || $timestamp >= $startDate) && ($endDate === null || $timestamp <= $endDate)) {
                $foundTimestamp = true;
            } else {
                $foundTimestamp = false;
            }
        }

        if ($foundTimestamp) {
            $filteredLines[] = $line;
        }
    }

    return implode("\n", $filteredLines);
}
?>
