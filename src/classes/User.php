<?php 
class User 
{
    private $user_login;
    private $user_password;
    private $user_profession;

    function __construct($data)
    {
        if(!empty($data)) {
            $this->user_login = $data['login'];
            $this->user_password = $data['password'];
            $this->user_profession = $data['radiobutton'];
        }
    }
    /**
     * 
     */
    private function createNewCustomer() : array 
    {
        $id = Generate::getUniqId('user_');
        $user_array[$this->user_login] = [
            'password' => Password::getHashPassword($this->user_password),
            'name' => ' ',
            'second_name' => ' ',
            'id' => $id,
            'date_of_dirth' => '',
            'date_of_register' => Generate::getDateFormat(),
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
        $id = Generate::getUniqId('user_');
        $user_array[$this->user_login] = [
            'password' => Password::getHashPassword($this->user_password),
            'name' => ' ',
            'id' => $id,
            'second_name' => ' ',
            'date_of_dirth' => ' ',
            'date_of_register' => Generate::getDateFormat(),
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
            $json['users'] += $this->createNewTranslator();
        } else {
            $json['users'] += $this->createNewCustomer();
        }
        JsonAction::setJsonFile($json, 'users');
    }

    /**
     * Возвращает объект сгенерированного пользователя
     */
    public function getPerson()
    {
        $json = JsonAction::readJSON();
        $person_id = $this->user_login;
        if(!empty($person)) {
            return $json[$person_id];
        }
    }
}