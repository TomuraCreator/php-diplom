<?php 


class JsonAction 
{
    private $PATH =  'C:\wamp64\www\DIPLOM-PHP\src\base\\';

    /**
     * Статический метод Хеширования пароля принимает аргументы 
     * @param string $pass пароль
     * @param int $argOfCrypt номер алгоритмов кодирования 1 - PASSWORD_DEFAULT (по умолчанию), 2 - PASSWORD_BCRYPT 
     * @return string хэш пароля 
     */
    static function getHashPassword(string $pass, int $argOfCrypt = PASSWORD_DEFAULT) : string 
    {
        if(!empty($pass)) {
            if($argOfCrypt === 1) {
                $argOfCrypt = PASSWORD_DEFAULT;
            } else if ($argOfCrypt === 1) {
                $argOfCrypt = PASSWORD_BCRYPT;
            }
            return password_hash($pass, $argOfCrypt);
        }
    }

    /**
     * Сравнивает пароль пользователя с хэш паролем
     * @param string $hash хэш пароль
     * @param string $pass пароль пользователя 
     * @return bool
     */
    static function comparisonPassword(string $hash, string $pass) : bool 
    {
        if(!empty($hash) && !empty($pass)) {
            return password_verify($pass, $hash);
        } else {
            throw new Exception('Empty data');
        }
    }

    /**
     * читает JSON файл по имени $file_name и возращает данные
     * @param string имя файла
     * @return string
     */
    static function readJSON(string $file_name) : string
    {
        if($this->getFileNameDirectory($file_name)) {
            $convert_json = file_get_contents($this->PATH);
            return json_decode($convert_json);
        }   
    }

    /**
     * Декодирует строку в JSON объект php
     * @param string строка 
     */
    public function getJsonDecode(string $json_string ) : string
    {
        if(!empty($json_string)) {
            return json_decode($json_string);
        }
    }

    /**
     * Проверяет наличие файла в дирректории base
     * @param string имя файла
     * @return bool
     */
    private function getFileNameDirectory(string $file_name) : bool
    {
        $file = $file_name . ".json";
        $scan = scandir($this->PATH);
        foreach($scan as $value) {
            if($file === $value) {
                return true;
            }
        }
    }

    /**
     * Устанавливает путь к базе данных 
     * @param string путь
     * @return bool
     */
    public function setPathConstant(string $path) : bool
    {
        if(!empty($path)) {
            $this->PATH = $path;
            return true;
        } else {
            return false;
        }
    }
    /**
     * Возвращает свойство PATH
     * @return string
     */
    public function getPath() : string 
    {
        return $this->PATH;
    }

}