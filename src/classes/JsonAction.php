<?php 

/**
 * Класс JsonAction содержит методы для взаимодействия с базой данных
 * @uses 
 */
class JsonAction 
{
    /**
     * читает JSON файл $file_name и возращает данные
     * @param string имя файла // 'users' по умолчанию
     * @return string
     */
    public static function readJSON(string $file_name = 'users') 
    {
        $path_name = $_SERVER['DOCUMENT_ROOT'] . '/src/base/' . $file_name . '.json';
        if(self::getFileNameDirectory($file_name)) {
            if(file_get_contents($path_name)) {
                $convert_json = file_get_contents($path_name);
                $decode = JsonAction::getJsonDecode($convert_json);
                return $decode;
            }
        }   
    }

    /**
     * Декодирует строку из JSON в объект php
     * @param string строка 
     */
    public static function getJsonDecode(string $json_string) : array
    {
        if(!empty($json_string)) {
            return json_decode($json_string, true);
        }
    }

    /**
     * Проверяет наличие файла в дирректории 
     * @param string имя файла
     * @param string имя директории ( base, root )
     * @return bool
     */
    public static function getFileNameDirectory(string $file_name) : bool
    {
        $file = $file_name . ".json";
        $route = $_SERVER['DOCUMENT_ROOT'] . '/src/base/';
        // switch($path) {
        //     case 'root':
        //         $route = $_SERVER['DOCUMENT_ROOT'] . '/';
        //         break;
        //     case 'base':
        //         $route = $_SERVER['DOCUMENT_ROOT'] . '/src/base/';
        //         break;
        // }
        $scan = scandir($route);
        
        foreach($scan as $value) {
            if($file === $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * Записывает данные в JSON 
     * @param array $data данные для записи
     * @param string $file_name (users - по умолчанию)
     * @return bool
     */
    public static function setJsonFile( $data, string $file_name = 'users') : bool
    {
        $path_name = $_SERVER['DOCUMENT_ROOT'] . '/src/base/'. $file_name . '.json';
        if(!empty($data) && self::getFileNameDirectory($file_name)) {
            $encode = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            file_put_contents($path_name, $encode);
            return true;
        }
        return false;
    }

    /**
     * Возвращает объект 
     * @param string $user логин переводчика
     * @param string $param возвращаемое свойство
     * @return mixed 
    */
    static function getPersonParam(string $user, string $file)
    {
        $json = JsonAction::readJSON($file);
        return $json[$user];
        // $user_obj = $json['users'][$user];
        // if(array_key_exists($param, $user_obj)) {
        //     return $user_obj[$param];
        // } 
    }
}
