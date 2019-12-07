<?php
class User
{
    private $user_login;
    private $user_password;
    private $user_profession;
    private $user_name;
    private $user_surname;
    private $translate;

    function __construct($data)
    {
        if(!empty($data)) {
            $this->user_login = $data['login'];
            $this->user_password = $data['password'];
            $this->user_profession = $data['radiobutton'];
            $this->user_name = $data['user_name'];
            $this->user_surname = $data['user_surname'];
            if(!empty($data['translate'])) {
                $this->translate = $data['translate'];
            }
        }
    }

    /**
     * 
     */
    private function createNewCustomer() : array 
    {
        $user_array[$this->user_login] = [
            'password' => Password::getHashPassword($this->user_password),
            'name' => $this->user_name,
            'second_name' => $this->user_surname,
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
        $user_array[$this->user_login] = [
            'password' => Password::getHashPassword($this->user_password),
            'name' => $this->user_name,
            'second_name' => $this->user_surname,
            'count_congestion' => 0,
            'date_of_register' => Generate::getDateFormat(),
            'completed_work' => 0,
            'group' => $this->user_profession,
            'translated' => [],
            'language_proficiency' => $this->translate,
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

    /**
     * Подсчитывает количество выполненных/выполняемых работ юзера и добавляет число в свойство completed_work
     * @param string $user - логин юзера в котором собирамся считать
     * @param string $position - позиция которую будем считать (translated- выполненные || during_translation - в процессе перевода)
     * @return bool
     */
    static function getCompletedWork(string $user, string $position) : bool
    {
        $json = JsonAction::readJSON('users');
        $user_obj = $json['users'][$user];
        if($position === 'translated') {
            $user_obj['completed_work'] = count($user_obj[$position]);
        } else if ($position === 'during_translation') {
            $user_obj['count_congestion'] = count($user_obj[$position]);
        } else {
            return false;
        }
        $json['users'][$user] = $user_obj;
        JsonAction::setJsonFile($json);
        return true;
    }

    /**
     * Добавляет переводчику id работы на перевод в свойство "during_translation" (array)
     * @param string $user логин переводчика
     * @param string $id id назначенной работы
     * @return void
     */
    static function writeIdToTranslater(string $user, string $id) : void
    {
        $json = JsonAction::readJSON('users');
        $user_obj = $json['users'][$user];
        array_push($user_obj['during_translation'], $id);
        $json['users'][$user] = $user_obj;
        JsonAction::setJsonFile($json, 'users');
        User::getCompletedWork($user, 'during_translation');
    }

    /**
     * Добавляет переводчику id работы "translated" (array)
     * @param string $user логин переводчика
     * @param string $id id выполненной работы
     * @return void
     */
    static function writeIdToSuccessfulTranslate(string $user, string $id) : void
    {
        $json = JsonAction::readJSON('users');
        $user_obj = $json['users'][$user];
        array_push($user_obj['translated'], $id);
        $json['users'][$user] = $user_obj;
        JsonAction::setJsonFile($json, 'users');
        User::getCompletedWork($user, 'translated');
    }

    /**
     * Возвращает значение свойства пользователя, если есть 
     * @param string $user логин переводчика
     * @param string $param возвращаемое свойство
     * @return mixed 
    */
    static function getPersonParam(string $user, string $param = null)
    {
        $json = JsonAction::readJSON('users');
        $user_obj = $json['users'][$user];
        if($param) {
            if(array_key_exists($param, $user_obj)) {
                return $user_obj[$param];
            } 
        } else {
           return $user_obj;
        }
    }

    /**
     * Обновить счётчики загружености переводчиков
     * 
     */
    static function reloadStatTranslator() : void
    {
        $json = JsonAction::readJSON('users');
        foreach($json['users'] as $user_log => $user) {
            if($user['group'] == 'translator') {
                self::getCompletedWork($user_log, 'during_translation');
            }
        }
    }
}