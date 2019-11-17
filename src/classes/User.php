<?php 
class User 
{
    private $user_name;
    private $user_password;
    private $user_profession;

    function __construct($data)
    {
        if(!empty($data)) {
            $this->user_name = $data['login'];
            $this->user_password = $data['password'];
            $this->user_profession = $data['radiobutton'];
        }
    }
    /**
     * 
     */
    private function createNewCustomer() : array 
    {
        $user_array = [
            'login' => $this->user_name,
            'password' => Password::getHashPassword($this->user_password),
            'group' => $this->user_profession,
            'offer_text' => []
        ];

        return $user_array;
    }

    /**
     * 
     */
    private function createNewTranslator() : array 
    {
        $user_array = [
            'login' => $this->user_name,
            'password' => Password::getHashPassword($this->user_password),
            'offer' => 0,
            'group' => $this->user_profession,
            'translated' => [],
            'language_proficiency' => [],
            'during_translation' => []
        ];
        return $user_array;
    }

    /**
     * 
     */
    public function saveUser() : void
    {
        $json = JsonAction::readJSON('users');
        $group = $this->user_profession;
        if($group === 'translator') {
            array_push($json['users'], $this->createNewTranslator());
        } else {
            array_push($json['users'], $this->createNewCustomer());
        }
        JsonAction::setJsonFile($json, 'users');
    }
}