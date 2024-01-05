This project is a simple PHP-based webhook & logger with an easy to use web interface. It logs incoming webhook data along with timestamps and IP addresses for easy tracking.

# How to Install
1. clone or download the repository into a spare folder
2. Copy all files except for .idea into your main server directory
3. your website and hook will now be up and running!

# Features
This section will be updated in the future.

## Resetting the Log
Click the "Reset Log" button on the web interface (index.php).
This will clear the log file (webhook.log).

## Formatting:
Timestamp Format: Each log entry includes a timestamp in the ISO 8601 format (e.g., 2022-01-04T12:34:56+00:00).
IP Address: The IP address of the sender is logged along with the data.

## Date Filtering:
Filter log entries by specifying start and end dates. This displays the entire log entry for each matching timestamp within the specified date range.

## Downloading Log
Click the "Download Log" button to download the entire log file (webhook.log).

# How to Send Data

You can send data to the webhook using various methods. Here are examples using JavaScript (fetch), cURL, HTTP(s), and HTML forms:

1. JavaScript (fetch):
  ```
  const webhookUrl = 'https://your-webhook-url/webhook.php';
  // Example data to send
  const data = {
    key1: 'value1',
    key2: 'value2',
  };
  
  // Send data using fetch
  fetch(webhookUrl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then(response => console.log('Webhook request sent successfully'))
    .catch(error => console.error('Error sending webhook request:', error));
  ```

2. cURL:
   ```curl -X POST -H "Content-Type: application/json" -d '{"key1":"value1","key2":"value2"}' https://your-webhook-url/webhook.php```

3. HTTP(s):
  ```
  POST /webhook.php HTTP/1.1
  Host: your-webhook-url
  Content-Type: application/json
  
  {"key1":"value1","key2":"value2"}
  ```

4. HTML form: (I personally like this one as it is nice to use)
  ```
  <form action="https://your-webhook-url/webhook.php" method="post">
    <input type="text" name="key1" value="value1">
    <input type="text" name="key2" value="value2">
    <input type="submit" value="Send to Webhook">
  </form>

  ```

Replace http://your-webhook-url/webhook.php with the actual URL of your deployed webhook endpoint.

# Notes:
This project is in active development, and more features will be added over time. Contributions and suggestions are welcome!

Feel free to use these examples as templates for integrating the webhook into your projects or testing it with various data formats.

Happy coding!
