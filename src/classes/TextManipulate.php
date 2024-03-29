<?php
/**
 * Класс реализовывает методы чтения, записи текста и изменения / удаления статуса задач
 */
class TextManipulate 
{
    private $form_data;
    private $translater_user;
    private $text_json;
    private $only_text_json;
    private $translate_text;
    private $translators;
    private $card_id;

    function __construct($data)
    {
        if($data) {
            $this->form_data = $data;
            if(!empty($data['login'])) {
                $this->translater_user = $data['login'];
            }
            $this->card_id = $data['card_id'];
            $this->text_json = JsonAction::readJSON('card_order');
            $this->only_text_json = JsonAction::readJSON('original_text');
            $this->translate_text = JsonAction::readJSON('translate_text');
            $this->translators = JsonAction::readJSON();
        }
    }

    /**
     * Сохраняет текст от переводчика в карточку и сохранение её в базу
     */
    public function saveText()
    {
        $translate_json = $this->translate_text[$this->card_id];

        foreach($this->form_data as $key_form => $value) {
            foreach($translate_json as $key_json => $values) {
                if($key_form == $key_json) {
                    $translate_json[$key_json] = $value;
                }
            } 
        }
        $this->translate_text[$this->card_id] = $translate_json;
        JsonAction::setJsonFile($this->translate_text, 'translate_text');

    }

    /**
     * Замена статуса перевода 
     * @param string status строка с типом статуса (resolved | done | undone)
     * @return bool
     */
    public function setStatusOnCard(string $status = 'resolved') 
    {   
        $id = $this->card_id;

        $this->text_json[$id]['status'] = $status;
        $this->only_text_json[$id]['status'] = $status;
        $this->translate_text[$id]['status'] = $status;

        JsonAction::setJsonFile($this->translate_text, 'translate_text');
        JsonAction::setJsonFile($this->only_text_json, 'original_text');
        JsonAction::setJsonFile($this->text_json, 'card_order');
    }

    /**
     * Удаляет карточки из базы 
     */
    static function deleteCardData(string $card_id = null) : void
    {
        $text_json = JsonAction::readJSON('card_order');
        $only_text_json = JsonAction::readJSON('original_text');
        $translate_text = JsonAction::readJSON('translate_text');
        
        if($card_id) {
            $translator = $text_json[$card_id]['translator'];
        }

        unset($text_json[$card_id], $only_text_json[$card_id], $translate_text[$card_id]);
        JsonAction::setJsonFile($text_json, 'card_order');
        JsonAction::setJsonFile($only_text_json, 'original_text');
        JsonAction::setJsonFile($translate_text , 'translate_text');

        User::deleteCardId($translator, $card_id);
    }

    /**
     * Возвращает свойство объекта
     * @param string имя свойства 
     */
    public function getParam(string $propName) 
    {
        $param = get_object_vars($this);
        if(!empty($param[$propName])) {
            return $param[$propName];
        }
    }
}    