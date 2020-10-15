<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="process.php" method="POST">
        <label for="login">
            Username:
        </label>
        <input type="text" name="login" id="login">
        <label for="password">
            Password:
        </label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Sign in" class="btn submit-btn">
    </form>
</body>
</html>