<?php
// Get request data
$data = file_get_contents('php://input');

// Determine message type
if (strpos($data, '[Type: PC Log]') !== false) {
    handlePCLog($data);
} else {
    handleNormalMessage($data);
}

// HTTP response code
http_response_code(200);

// Functions to handle different message types
function handleNormalMessage($data) {
    // Add code here to handle normal messages
    file_put_contents('webhook.log', $data, FILE_APPEND | LOCK_EX);
}

function handlePCLog($data) {
    // Extract computer name from the header
    preg_match("/\[Computer: (.+?)\]/", $data, $matches);
    $computerName = isset($matches[1]) ? $matches[1] : '';

    if ($computerName !== '') {
        // Save PC log to individual file
        $pcLogFile = "pc_logs/{$computerName}_log.txt";
        file_put_contents($pcLogFile, $data, FILE_APPEND | LOCK_EX);
    }
}
?>
