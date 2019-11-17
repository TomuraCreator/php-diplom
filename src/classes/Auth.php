<?php
class Auth 
{
    private $user_name;
    private $user_password;
    private $user_commit;

    function __construct($user) {
        if(!empty($user)) {
            $this->user_name = $user['login'];
            $this->user_password = $user['password'];
        }
    }

    /**
     * ищет в базе логин из формы пользователя
     * @return bool
     */
    public function findLogin() : bool
    {
        $users_list = JsonAction::readJSON('users');
        foreach ($users_list['users'] as $user) {
            if($user['login'] === $this->user_name) {
                $this->user_commit = $user;
                return true;
            }
        }
        return false;
    }

    /**
     * Проверяет соответствие хэш в базе с паролем из формы
     * @return bool
     */
    private function checkPass() : bool 
    {
        $hash = $this->user_commit['password'];
        $user_pass = $this->user_password;

        if(Password::comparisonPassword($hash, $user_pass)) {
            return true;
        }          
        return false;
    }

    /**
     * Проверяет данные пользователя (логин, пароль)
     * @return bool
     */
    public function islogin() : bool
    {
        if($this->findLogin()) {
            if($this->checkPass()) {
                return true;
            }
        }
        return false;
    }
}