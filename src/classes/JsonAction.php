<?php 

/**
 * Класс JsonAction содержит методы для взаимодействия с базой данных
 * @uses 
 */
class JsonAction 
{
    private static $PATH =  'C:\wamp64\www\DIPLOM-PHP\src\base\\';

    
    /**
     * читает JSON файл по имени $file_name и возращает данные
     * @param string имя файла // 'users' по уполчанию
     * @return string
     */
    public static function readJSON(string $file_name = 'users')
    {
        $path_name = self::$PATH . $file_name . '.json';
        if(self::getFileNameDirectory($file_name)) {
            $convert_json = file_get_contents($path_name);
            $decode = JsonAction::getJsonDecode($convert_json);
            return $decode;
        }   
    }

    /**
     * Декодирует строку в JSON объект php
     * @param string строка 
     */
    public static function getJsonDecode(string $json_string) : array
    {
        if(!empty($json_string)) {
            return json_decode($json_string, true);
        }
    }

    /**
     * Проверяет наличие файла в дирректории base
     * @param string имя файла
     * @return bool
     */
    private static function getFileNameDirectory(string $file_name) : bool
    {
        $file = $file_name . ".json";
        $scan = scandir(self::$PATH);
        
        foreach($scan as $value) {
            if($file === $value) {
                return true;
            }
        }
        return true;
    }

    /**
     * Устанавливает путь к базе данных 
     * @param string путь
     * @return bool
     */
    public static function setPathConstant(string $path) : bool
    {
        if(!empty($path)) {
            self::$PATH = $path;
            return true;
        } else {
            return false;
        }
    }
    /**
     * Возвращает свойство PATH
     * @return string
     */
    public static function getPath() : string 
    {
        return self::$PATH;
    }

    /**
     * Записывает данные в JSON 
     * @param array $data данные для записи
     * @param string $file_name (users - по умолчанию)
     * @return bool
     */
    public static function setJsonFile( $data, string $file_name = 'users') : bool
    {
        $path_name = self::$PATH . $file_name . '.json';
        if(!empty($data) && self::getFileNameDirectory($file_name)) {
            $encode = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            file_put_contents($path_name, $encode);
            return true;
        }
        return false;
    }
}
