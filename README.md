# Webhook & Logger

This project is a versatile PHP-based webhook and logger system with an easy-to-use web interface. It allows you to log incoming webhook data, including timestamps, IP addresses, and provides a streamlined way to view and manage logs.

## Table of Contents
- [Installation](#installation)
- [Webhook Features](#features)
    - [Webhook Viewer](#webhook-viewer)
    - [PC Log Viewer](#pc-log-viewer)
    - [PC Info Viewer](#pc-info-viewer)
    - [How To Use](#how-to-use)
- [Other Features](#other-features)
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

#### Future Customization
In future updates, additional customization options for headers will be introduced, providing users with even more control over their webhook messages.

### PC Log Viewer
The PC Log Viewer organizes logs sent from different devices into separate pages. Each device's logs are accessible through links on the PC Log Viewer page. The structure includes:

- **PC Log Viewer Landing Page (`pc_log_viewer.php`):** Lists links to individual PC logs.
- **Individual PC Log Pages (`pc_logs/`):** Dedicated pages for each device, showing the respective log content.

### PC Info Viewer
The PC Info Viewer organizes information sent with the header `[Type: PC Info]`. Each device's information is accessible through links on the PC Info Viewer page.



#### Headers
I WILL UPDATE THIS SECTION
Custom headers allow you to categorize and distinguish different types of webhook messages. Currently supported headers include:

- `[Type: PC Log]`: Indicates a log message from a computer.
- `[Computer: PC1]`: Specifies the name of the computer sending the log.
- `[Type: PC Info]`: Indicates information about a computer.
- `[Computer: PC1]`: Specifies the name of the computer providing the information.

Look at the sending examples to see how to include these headers in your requests. The PC Info header helps the system distinguish between PC Logs and PC Info, ensuring proper organization and display.
The headers are actually very simple and allow you to sort webhook messages across pages in the site. I reccommend using them if you're sending lots of stuff to the webhook.

# Other Features

### Downloads
There is a downloads page accessible via the landing page which contains a table with files you can download. The files have to uploaded manually (obviously) and then the reference to the file has to be created in the table by editing the downloads.html file. It is good practise to upload the files to a seperate folder as you can see like I have with "file_downloads"

# How to Use

#### How to Send PC Info Data
To send PC Info data, include the `[Type: PC Info]` header along with the `[Computer: PC1]` header (replace "PC1" with the actual name of the computer) in your request. Here's an example using JavaScript (fetch):

```javascript
// Example data to send PC Info
// Include Type and Computer headers to distinguish PC Info
fetch('https://your-webhook-url/webhook.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'text/plain',
    'Custom-Header': 'Header-Value',
    'Type': 'PC Info',
    'Computer': 'PC1',  // Replace with the actual PC name
  },
  body: 'PC Info content here.',
})
  .then(response => console.log('Webhook request sent successfully'))
  .catch(error => console.error('Error sending webhook request:', error));
```
Ensure that you replace "PC1" with the actual name of the computer when sending PC Info data. This way, the system can properly distinguish between PC Logs and PC Info, organizing the data accordingly.

### How to Send Data

You can send data to the webhook using various methods. Below are examples using JavaScript (fetch), cURL, HTTP(s), and HTML forms:

JavaScript (fetch):

```javascript
// Example data to send
// Send plain text data using fetch with custom headers
fetch('https://your-webhook-url/webhook.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'text/plain',
    'Custom-Header': 'Header-Value',
    'Type': 'PC Log',  // Example Type header for PC Log
    'Computer': 'PC1',  // Example Computer header for PC Log
  },
  body: '[Type: PC Log] [Computer: PC1] PC log content here.',
})
  .then(response => console.log('Webhook request sent successfully'))
  .catch(error => console.error('Error sending webhook request:', error));
```

cURL:
```
curl -X POST -H "Content-Type: text/plain" -H "Type: PC Log" -H "Computer: PC1" -d "[Type: PC Log] [Computer: PC1]\nPC log content here." https://your-website.com/webhook.php
```
HTML form:
```html
<form action="https://your-webhook-url/webhook.php" method="post">
  <input type="text" name="key1" value="value1">
  <input type="text" name="key2" value="value2">
  <input type="submit" value="Send to Webhook">
</form>
```

Replace https://your-webhook-url/webhook.php with the actual URL of your deployed webhook endpoint.

### Notes

This project is actively developed, and more features will be added over time. Contributions and suggestions are welcome! Use the provided examples as templates for integrating the webhook into your projects or testing it with various data formats.

Happy coding!

Feel free to let me know if there are any further adjustments or if you have additional requests!

I KNOW THIS README MAKES NO SENSE. I am working on it :).
