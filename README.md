THIS PROJECT IS IN ACTIVE DEVELOPMENT (until I forget it exists). More features will be added as I use the project more :)

Very easy to use and simple webhook to host on your web server. Only requirement is you have php installed (which you automatically should).
This is a basic PHP-based webhook logger with a minimal web interface. It logs incoming webhook data along with timestamps and IP addresses for easy tracking.

# How to Install
1. Copy all files except for .idea into your main server directory
2. thats pretty much it lol.

# Features
This section will be updated in the future.

## Resetting the Log
Click the "Reset Log" button on the web interface (index.php).
This will clear the log file (webhook.log).

## Formatting:
Timestamp Format: Each log entry includes a timestamp in the ISO 8601 format (e.g., 2022-01-04T12:34:56+00:00).
IP Address: The IP address of the sender is logged along with the data.

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

Feel free to use these examples as templates for integrating the webhook into your projects or testing it with various data formats.

Happy coding!
