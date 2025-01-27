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
        <!-- Форма поиска -->
        <form method="GET" action="index.php">
            <input name="search" type="text" placeholder="search todos">
            <button class="submit-btn" type="submit">Search</button>
        </form>
<!--        Если что то ввели в поле для поиска-->
        <?php if ($search_result !== ''): ?>
            <h2>Search result:</h2>
            <?php if (empty($search_result)):?> <!--Если результат поиска == false-->
                <h3>Nothing found matching your request.</h3>
            <?php else: ?> <!-- Результат поиска -->
                <ul>
                    <?php for ($i=0;$i<count($search_result);$i++): ?>
                        <li>
                            <?= $search_result[$i]['task'] ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            <?php endif; ?>
        <!-- Блок кода если поле для поиска пустое -->
        <?php else: ?>
            <ul>
                <?php for ($i=0;$i<count($all_data);$i++):?>
                <li>
                    <input type="hidden" name="id" value="<?= $all_data[$i]['id'] ?>">
                    <?= $all_data[$i]['task'] ?>
                    <div class="icon-container">
                        <a href="<?=DEFAULT_URL?>update.php?update_id=<?=urlencode($all_data[$i]['id'])?>" class="icon-link"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="<?=DEFAULT_URL?>action.php?delete_id=<?=urlencode($all_data[$i]['id'])?>" class="icon-link"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
                <?php endfor; ?>
            </ul>
            <h2>Add a new todo...</h2>
            <form action="action.php" method="POST">
                <input name="add_todo" type="text" placeholder="write new todo">
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
