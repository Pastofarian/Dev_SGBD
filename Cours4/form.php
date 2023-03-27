<?php
header("Location: form.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="email" name="email">
        <input type="text" name="password">
        <input type="submit">
    </form>
</body>
</html>