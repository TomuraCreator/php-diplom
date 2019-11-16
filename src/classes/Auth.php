<?php
class Auth 
{
    private $user_name;
    private $user_password;
    private $user_commit;

    function __construct($user) {
        if(!empty($user)) {
            $this->user_name = $user->login;
            $this->user_password = $user->password;
        }
    }

    private function findLogin() : bool
    {
        $users_list = $this->json->users;
        foreach ($users_list as $user) {
            if($user->login === $this->user_name) {
                $this->user_commit = $user;
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Проверяет соответствие 
     */
    private function checkPass() : bool 
    {
        $hash = $this->json->password;
        $user_pass = $this->user_name->password;

        if(JsonAction::comparisonPassword($hash, $user_pass)) {
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