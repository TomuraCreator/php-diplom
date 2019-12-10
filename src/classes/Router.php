<?php
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
        if($this->get['name'] === 'register') {
            $this->auth = new Auth($POST);
            $this->user = new User($POST);
            $this->toRegister();
        } elseif($this->get['name'] === 'login') {
            $this->auth = new Auth($POST);
            $this->toAuthLogin();
        } elseif($this->get['name'] === 'loginout') {
            $this->logOut();
        } elseif($this->get['name'] === 'new_order') {
            try {
                $this->saveOrder();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            User::reloadStatTranslator();
            header('Location: body.php');
        } elseif($this->get['name'] === 'edit_card') {
            $this->saveCardText();
        } elseif($this->get['name'] === 'delete_card') {

        }
    }
    private function isError() 
    {

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
        new Order($this->post);
    }

    /**
     * После разлогина перенаправляет пользователя на лендинг 
     * стирает куки
     */    
    private function logOut() : void
    {
        session_destroy();
        session_gc();
        header("Location: index.php");
        exit;
    }

    /**
     * Перенаправляет на главную страницу, после сохранения перевода
     */
    private function saveCardText() : void
    {
        $modernize_text = new TextManipulate($this->post);
        $modernize_text->saveText();
        $modernize_text->setStatusOnCard('resolved');
        header('Location: body.php');
    }
}   