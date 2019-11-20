<?php 
/**
 * Вспомогательный класс для генерации данных
 */
class Generate 
{
    /**
     * Генерирует уникальный id 
     */
    public static function getUniqId(string $prefix = '', bool $entropy = true) : string
    {
        return uniqid($prefix, $entropy);
    }
    /**
     * Возвращает актуальную дату в формате Y-m-d H:i:s
     */
    public static function getDateFormat(string $time_stamp = '') : string 
    {
        $today = null;
        if(!empty($time_stamp)) {
            $today = date("Y-m-d H:i:s", $time_stamp);
        } else {
            $today = date("Y-m-d H:i:s");
        }
        return $today;
    }
}