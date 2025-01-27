<?php
require_once 'action.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!--Подключаю шрифт    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <!--Подключаю style.css    -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Подключение Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<div class="main-content">
    <h1><a href="index.php">TO-DO LIST</a></h1>

    <div class="content">
        <form action="action.php" method="POST">
            <input type="hidden" name="id_update" value="<?=$data['id']?>">
            <input name="task_update" class="update-input" type="text" placeholder="Enter your todos" value="<?=$data['task']?>">
            <button class="submit-btn" type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
