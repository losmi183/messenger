<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Android App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        a.button {
            display: inline-block;
            padding: 15px 25px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome to Crypt Talk</h1>
    <p>Click the button below to download the Android app:</p>
    <a href="{{ asset('downloads/app-release-signed.apk') }}" class="button" download>
        Download Android App
    </a>
</body>
</html>
