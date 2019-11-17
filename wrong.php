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
    <title>Document</title>
</head>
<body>
    <div class="wrapper_form header_form">
        <form action="<?php echo $action_adress . "?name=login"?>" method="post" class="footer_form ">
            <input type="mail" name="login" maxlength="20" placeholder="email" required>
            <input type="password" maxlength="20" name="password" placeholder="password" required>
            <input type="submit" value="Отправить" >
        </form>
        <p>не верное имя пользователя или пароль</p>
    </div>
</body>
</html>
