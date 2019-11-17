<?php 
$action_adress = 'redirection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/style/normalize.css">
    <link rel="stylesheet" href="./src/style/login_page_style.css">
    <title>Document</title>
</head>
<body>
    <div class="body_art">
        <div class="wrapper_top_header">
            <header class="header">
                
                <div class="wrapper_menu">
                
                    <div class="title_near_menu button_header_menu">
                        <span>
                            RW menu
                        </span>
                    </div>
                    <ul class="list_header_menu">
                        <li><a href="#" class="login_button">log in</a></li>
                        <li><a href="#" class="register_button">register</a></li>
                    </ul>
                </div>
                <div class="wrapper_tel_header">
                    <a href="tel:+7 700 700 70 70"> +7 700 700 70 70</a>
                </div>

            </header>

            <div class="wrapper_title">
                <h1>ReaDandWrite</h1>
                
            </div>
        </div>
    </div>
    <div class="main_stream">
        <div class="under_main_stream">
            <article class="article previous_product">
                <div class="wrapper_article">
                    <h2 class="title_wrapper_article">
                        Лучшие из лучших 
                    </h2>
                    <div class="wrapper_article_tocontent">
                        <p>
                        Переводчики  студии ReaDandWrite обладают богатейшим опытом переводов самой разной тематики. Мы стараемся всегда быть в курсе технических инноваций в сфере перевода и следить за новшествами современных технологий и сферы бизнеса.

                        Мы работаем над заказами любой сложности и предоставляем работу в удобные для Вас сроки.

                        По Вашему желанию мы предоставляем всю информацию о ведении того или иного заказа, также возможна поступательная сдача заказов, корректировка в процессе перевода.  
                        </p>
                        <div class="image_subtitle">
                            <img src="https://pln-pskov.ru/pictures/150313154835.jpg" alt="глобус и языки">
                        </div>
                        
                    </div>
            </article>
            <article class="article previous_product">
                <div class="wrapper_article">
                    <h2 class="title_wrapper_article">
                        Только идеальный результат
                    </h2>
                    <div class="wrapper_article_tocontent">
                        <div class="image_subtitle">
                            <img src="https://doshkolniki.org/images/obuchenie/inostrannyj/1902-izuchenie-inostrannogo-yazyka.jpg" alt="глобус и языки">
                        </div>
                        <p>
                        Важная деталь: в нашей студии нет ограничения по минимальному и максимальному объему текста. Мы принимаем заказы как от одного предложения, так и до тысяч знаков текста. Оформление заявки на перевод максимально быстрое: нужно лишь заполнить форму онлайн заказа.
                        Основная задача нашей компании – выполнять свою работу так, чтобы Вы видели в нас долгосрочного партнера, который не подведет, и на которого можно всегда положиться. Наши клиенты – наша главная ценность, а их интересы – это наши интересы.
                        </p>
                    </div>
            </article>
            <article class="article previous_product">
                <div class="wrapper_article">
                    <h2 class="title_wrapper_article">
                        Только идеальный результат
                    </h2>
                    <div class="wrapper_article_tocontent">
                        <p>
                        Важная деталь: в нашей студии нет ограничения по минимальному и максимальному объему текста. Мы принимаем заказы как от одного предложения, так и до тысяч знаков текста. Оформление заявки на перевод максимально быстрое: нужно лишь заполнить форму онлайн заказа.
                        Основная задача нашей компании – выполнять свою работу так, чтобы Вы видели в нас долгосрочного партнера, который не подведет, и на которого можно всегда положиться. Наши клиенты – наша главная ценность, а их интересы – это наши интересы.
                        </p>
                        <div class="image_subtitle">
                            <img src="http://rustudent.com/wp-content/uploads/2013/01/Kontsept-i-mifema-kak-konstruktyi-yazyikovogo-prostranstva.jpg" alt="глобус и языки">
                        </div>
                    </div>
            </article>
            <article class="article previous_product">
                <div class="wrapper_article">
                    <h2 class="title_wrapper_article">
                        Только идеальный результат
                    </h2>
                    <div class="wrapper_article_tocontent">
                        <div class="image_subtitle">
                            <img src="http://drlingvo.com/wp-content/uploads/2015/07/Logo_Int_tongues_small-624x480.png" alt="глобус и языки">
                        </div>
                        <p>
                        Важная деталь: в нашей студии нет ограничения по минимальному и максимальному объему текста. Мы принимаем заказы как от одного предложения, так и до тысяч знаков текста. Оформление заявки на перевод максимально быстрое: нужно лишь заполнить форму онлайн заказа.
                        Основная задача нашей компании – выполнять свою работу так, чтобы Вы видели в нас долгосрочного партнера, который не подведет, и на которого можно всегда положиться. Наши клиенты – наша главная ценность, а их интересы – это наши интересы.
                        </p>
                    </div>
            </article>
        </div>
    </div>
    <footer class="footer">

        <div class="wrapper_footer">
            <div class="wrapper_form header_form deactive">
                <h3>Войти в личный кабинет</h3>
                <form action="<?php echo $action_adress . "?name=login"?>" method="post" class="footer_form ">
                    <input type="mail" name="login" maxlength="20" placeholder="email" required>
                    <input type="password" maxlength="20" name="password" placeholder="password" required>
                    <input type="submit" value="Отправить" >
                </form>
            </div>
            <div class="wrapper_form header_form">
                <h3>Зарегестрироваться</h3>
                <form action="<?php echo $action_adress . "?name=register"?>" method="post" class="footer_form ">
                    <input type="mail" name="login" maxlength="20" placeholder="email" required>
                    <input type="password" maxlength="20" name="password" placeholder="password" required>
                    <div>
                        <input type="radio" name="radiobutton" value="customer" id="customer" required>
                        <label for="customer">Заказчик</label>
                        <input type="radio" name="radiobutton" value="translator" id="translator" required>
                        <label for="translator">Переводчик</label>
                    </div>
                    <input type="submit" value="Отправить" >
                </form>
            </div>
        </div>
    <script src="src/script/landing.js"></script>
    </footer>
</body>
</html>