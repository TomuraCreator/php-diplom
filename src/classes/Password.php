<?php 
class Password 
{
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

}