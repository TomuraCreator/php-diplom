<?php 
$action_adress = 'redirection.php';
$post = $_POST;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/style/register.css">
    <title>login</title>
</head>
<body>
    <div class="wrapper_form header_form">
        
        <form action="<?php echo $action_adress . "?name=register"?>" method="post" class="footer_form ">
            <input type="text" name="user_name" maxlength="20" placeholder="Введите ваше имя" required>
            <input type="text" name="user_surname" maxlength="20" placeholder="Введите вашу фамилию" required>
            <?php foreach( $post as $value_name => $value): ?>
                <input type="hidden" name="<?php echo $value_name ?>" value="<?php echo $value ?>">
            <?php endforeach;?>
            <?php if($_POST['radiobutton'] === 'translator'): ?>
            <fieldset class="translate_text">
                <legend>Выберите язык(и) которым владеете</legend>
                <div>
                    <input type="checkbox" name="translate[]" value="rus" id="rus" checked>
                    <label for="rus">Русский</label>
                </div>
                <div>
                    <input type="checkbox" name="translate[]" value="eng" id="eng" checked>
                    <label for="eng">Английский</label>
                </div>
                <div>
                    <input type="checkbox" name="translate[]" value="deu" id="deu">
                    <label for="deu">Немецкий</label>
                </div>
                <div>
                    <input type="checkbox" name="translate[]" value="fra" id="fra">
                    <label for="fra">Французский</label>
                </div>
                <div>
                    <input type="checkbox" name="translate[]" value="it" id="it">
                    <label for="it">Итальянский</label>
                </div>
                <div>
                    <input type="checkbox" name="translate[]" value="esp" id="esp">
                    <label for="esp">Испанский</label>
                </div>
            </fieldset>
            <?php endif; ?>
            <input type="submit" value="Отправить" >
        </form>
    </div>
</body>
</html>
