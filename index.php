<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Webhook Log</title>
</head>
<body>
    <div class="log-window">
        <h2>Webhook Log</h2>
        <form action="reset.php" method="post">
            <button type="submit">Reset Log</button>
        </form>
        <pre><?php include __DIR__ . '/webhook.log'; ?></pre>
    </div>
</body>
</html>
