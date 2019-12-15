<?php
/**
 * Перенаправляет пользователя
*/
class Router
{
    private $post;
    private $get;
    private $auth;
    private $PATH; 
    private $user;

    public function __construct(array $GET = null, array $POST = null)
    {
        session_start();

        $this->PATH = $_SERVER['DOCUMENT_ROOT'] . '/DIPLOM-PHP'; // не уверен в использовании
        if($GET) {
            $this->get = $GET;
        } if($POST) {
            $this->post = $POST;
        }
        if($this->get['name'] === 'register') { //регистрация
            $this->auth = new Auth($POST);
            $this->user = new User($POST);
            $this->toRegister();
            User::reloadStateUsersCategory();

        } elseif($this->get['name'] === 'login') { // логин
            $this->auth = new Auth($POST);
            $this->toAuthLogin();

        } elseif($this->get['name'] === 'loginout') { //разлогин
            $this->logOut();

        } elseif($this->get['name'] === 'new_order') { // создание новой карточки с текстом
            $this->saveOrder();
            User::reloadStatTranslator();
            header('Location: body.php');

        } elseif($this->get['name'] === 'edit_card') { // отправка переведённого текста переводчиком
            $this->saveCardText();

        } elseif($this->get['name'] === 'delete_card') { //удаление карточки 
            $this->removeCard();
            
        } elseif($this->get['name'] === 'show_card') { // показ формы для подтверждения
            $this->showCard();
        } elseif($this->get['name'] === 'change_order') { // показ формы редактирования
            $this->saveChangesBeforeEdit();

        }
    }

    /**
     * Перенаправляет на страницу редактинга после авторизаци 
     * добавляет куки
     */
    private function toAuthLogin() : void
    { 
        if($this->auth->isLogin()) {
            $_SESSION['user'] = User::getPersonParam($this->post['login']);
            $_SESSION['login'] = $this->post['login'];
            header("Location: body.php");
            exit;
        } else {
            header("Location: login.php");
            exit;
        }
    }
    /**
     * Перенаправляет на страницу редактинга после регистрации 
     * внесение пользователя в базу данных
     * @param $post результат post запроса
     */
    private function toRegister() : void
    {
        if($this->auth->findLogin()) {
            header("Location: index.php?is_user=true");
            exit;
        } else {
            $this->user->saveUser();
            $_SESSION['user'] = User::getPersonParam($this->post['login']);
            $_SESSION['login'] = $this->post['login'];
            header("Location: body.php");
            exit;
        } 
    }

    /**
     * 
     */
    private function saveOrder() : void
    {

        $order = new Order($this->post);
        $order->setTextComplete();
    }

    /**
     * После разлогина перенаправляет пользователя на лендинг 
     * стирает куки
     */    
    private function logOut() : void
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    /**
     * Сохраняет изменения внесённые переводчиком и перенаправляет на главную страницу 
     * @return void
     */
    private function saveCardText() : void
    {
        $modernize_text = new TextManipulate($this->post);
        $modernize_text->saveText();
        $modernize_text->setStatusOnCard('resolved');
        header('Location: body.php');
    }

    /**
     * Производит удаление данных в карточках с текстом на перевод, удаляет идентификатор заказа на перевод у переводчика, перенаправляет на главную страницу  
     * @return void
     */
    private function removeCard() : void
    {
        TextManipulate::deleteCardData($this->get['id']);
        User::reloadStatTranslator();
        header('Location: body.php');
    }

    /**
     * Перенаправляет на главную, меняет статус на принят или отклонён
     * @return void
     */
    private function showCard() : void
    {
        $post = $this->post;
        if(!empty($post['confirm'])) {
            $modernize_text = new TextManipulate($this->post);
            $modernize_text->setStatusOnCard('done');
            $param = $modernize_text->getParam('text_json');
            $login = $param[$post['card_id']]['translator'];
            User::writeIdToSuccessfulTranslate($login, $post['card_id']);
            User::deleteCardId($login, $post['card_id']);

        } elseif(!empty($post['rifiutare'])) {
            $modernize_text = new TextManipulate($this->post);
            $modernize_text->setStatusOnCard('undone');
        }
        header('Location: body.php');
    }

    /**
     * Сохраняет изменения внесённые в задачу менеджером после исправлений
     * @return void
     */
    private function saveChangesBeforeEdit() : void
    {
        $order = new Order($this->post);
        $order->setTextComplete($this->get['id']);
        header('Location: body.php');
    }
}   
