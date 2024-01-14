# Webhook & Logger

This project is a versatile PHP-based webhook and logger system with an easy-to-use web interface. It allows you to log incoming webhook data, including timestamps, IP addresses, and provides a streamlined way to view and manage logs.

## Table of Contents
- [Installation](#installation)
- [Features](#features)
  - [Webhook Viewer](#webhook-viewer)
  - [PC Log Viewer](#pc-log-viewer)
- [How to Send Data](#how-to-send-data)

## Installation
1. Clone or download the repository into a spare folder.
2. Copy all files except for `.idea` into your main server directory.
3. Your website and hook will now be up and running!

## Features

### Webhook Viewer
The Webhook Viewer provides a detailed display of incoming webhook messages with additional functionalities:

- **Search:** Use the search bar to find specific keywords in the logs.
- **Date Filtering:** Filter log entries by specifying start and end dates.
- **Reset Log:** Click the "Reset Log" button to clear the entire log file.
- **Download Log:** Download the entire log file using the "Download Log" button.
- **Navigation Buttons:** Navigate through individual log entries easily.

#### Headers
Custom headers allow you to categorize and distinguish different types of webhook messages. Currently supported headers include:

- `[Type: PC Log]`: Indicates a log message from a computer.
- `[Computer: PC1]`: Specifies the name of the computer sending the log.

Look at the cURL code example to see them in actual use.

#### Future Customization
In future updates, additional customization options for headers will be introduced, providing users with even more control over their webhook messages.

### PC Log Viewer
The PC Log Viewer organizes logs sent from different devices into separate pages. Each device's logs are accessible through links on the PC Log Viewer page. The structure includes:

- **PC Log Viewer Landing Page (`pc_log_viewer.php`):** Lists links to individual PC logs.
- **Individual PC Log Pages (`pc_logs/`):** Dedicated pages for each device, showing the respective log content.

## How to Send Data

You can send data to the webhook using various methods. Below are examples using JavaScript (fetch), cURL, HTTP(s), and HTML forms:

1. **JavaScript (fetch):**
    ```javascript
        // Example data to send
        // Send plain text data using fetch with custom headers
    fetch('https://your-webhook-url/webhook.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'text/plain',
        'Custom-Header': 'Header-Value',
      },
      body: '[Type: PC Log] [Computer: PC1] PC log content here.',
    })
      .then(response => console.log('Webhook request sent successfully'))
      .catch(error => console.error('Error sending webhook request:', error));
    ```

2. **cURL:**
    ```bash
    curl -X POST -H "Content-Type: text/plain" -d "[Type: PC Log] [Computer: PC1]\nPC log content here." https://your-website.com/webhook.php
    ```
    As you can see there are two "headers" in use here. The PC Log sorts the webhook message into the pc logging part of the web server and the computer specifies which computer sent the message. This can be customized to your needs.

3. **HTTP(s):**
    ```http
    POST /webhook.php HTTP/1.1
    Host: your-webhook-url
    Content-Type: application/json
    Custom-Header: Header-Value
    
    {"key1":"value1","key2":"value2"}
    ```

4. **HTML form:**
    ```html
    <form action="https://your-webhook-url/webhook.php" method="post">
      <input type="text" name="key1" value="value1">
      <input type="text" name="key2" value="value2">
      <input type="submit" value="Send to Webhook">
    </form>
    ```

Replace `https://your-webhook-url/webhook.php` with the actual URL of your deployed webhook endpoint.

## Notes
This project is actively developed, and more features will be added over time. Contributions and suggestions are welcome! Use the provided examples as templates for integrating the webhook into your projects or testing it with various data formats.

Happy coding!
