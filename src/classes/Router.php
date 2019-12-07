<?php
class Router
{
    private $post;
    private $get;
    private $auth;
    private $PATH; 

    public function __construct(array $GET = null, array $POST = null)
    {
        session_start();
        $this->PATH = $_SERVER['DOCUMENT_ROOT'] . '/DIPLOM-PHP';
        if($GET) {
            $this->get = $GET;
        } if($POST) {
            $this->post = $POST;
            $this->auth = new Auth($POST);
        }
        if($this->get['name'] === 'register') {
            $this->toRegister();
        } elseif($this->get['name'] === 'login') {
            $this->toAuthLogin();
        } elseif($this->get['name'] === 'loginout') {
            self::logOut();
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
            header("Location: body.php");
            exit;
        } 
    }

    /**
     * После разлогина перенаправляет пользователя на лендинг 
     * стирает куки
     */    
    public function logOut() : void
    {
        session_destroy();
        session_gc();
        header("Location: index.php");
        exit;
    }
}