<?php 
$name_string = 'Anonimous';
$name_role = 'koordinator';
$image = null;



?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name_string ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="src/image/007-pencil2.png" type="image/x-icon">
    <link rel="stylesheet" href="src/style/normalize.css">
    <link rel="stylesheet" href="src/style/header.css">
    <link rel="stylesheet" href="src/style/body.css">
    <link rel="stylesheet" href="src/style/order_form.css">
    

</head>
<body>
    
    <header class="header header-inner">
        <div class="wrapper_header">
            <div class="button_hide_out">
                <div></div>
            </div>
            
            <a class="logout-button" href="login.php?name=false">
                <img src="src/image/276-enter.png" alt="">
            </a>
        </div>
    </header>
    
    <div class="sidebar">
        <div class="photo-wrap">
        <?php if(empty($image)): ?>
            <img src="src/image/undefined_user.jpg" alt="Аноним">
        <?php else : ?>
            <img src="src/image/undefined_user.jpg" alt="Фото">
        <?php endif ?>
        </div>
        <p class="user-name"><?php echo $name_string ?></p>
        <p class="user-role"><?php echo $name_role ?></p>
        <div class="filter">
            <h3 class="filter-title">Задания</h3>
            <ul class="filter-items">
                <li class="filter-item filter-item_active">  
                    <a href="index.php">Все</a>
                </li>
                <li class="filter-item">
                    <a href="index.php?filter=new">Новые</a>
                </li>
                <li class="filter-item">
                    <a href="index.php?filter=resolved">На проверке</a>
                </li>
                <li class="filter-item">
                    <a href="index.php?filter=rejected">Отклонённые</a>
                </li>
                <li class="filter-item">
                    <a href="index.php?filter=done">Выполненные</a>
                </li>
            </ul>
        </div>
    </div>
    <script src="src/script/header.js"></script>
</body>
</html>