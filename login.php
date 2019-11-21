<?php 
$action_adress = 'redirection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/style/wrong.css">
    <title>login</title>
</head>
<body>
    <div class="wrapper_form header_form">
        <form action="<?php echo $action_adress . "?name=login"?>" method="post" class="footer_form ">
            <input type="text" name="login" maxlength="20" placeholder="login" required>
            <input type="password" maxlength="20" name="password" placeholder="password" required>
            <input type="submit" value="Отправить" >
        </form>
        <?php if(empty($_GET["name"])): ?>
            <p>не верное имя пользователя или пароль</p>
        <?php endif ?>
    </div>
</body>
</html>
