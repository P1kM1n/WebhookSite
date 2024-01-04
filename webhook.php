<?php
// Get request data
$data = file_get_contents('php://input');
$decodedData = urldecode($data); // Decode URL-encoded data

// Additional information
$timestamp = date('c'); // Timestamp of the request
$ipAddress = $_SERVER['REMOTE_ADDR']; // IP address of the request sender

// Log entry format
$logEntry = "Timestamp: {$timestamp}\nIP Address: {$ipAddress}\nData:\n {$decodedData}\n------------------------\n";

// Save log entry to file
file_put_contents('webhook.log', $logEntry, FILE_APPEND | LOCK_EX);

// HTTP response code
http_response_code(200);
?>
