<?php 
class Order 
{
    private $executor;
    private $customer;
    private $origin_lang;
    private $translate_lang;
    private $text_to_translate;
    private $deadline;
    private $id_text;

    function __construct($post_obj = null)
    {
        if($post_obj) {
            $this->executor = $post_obj['selected_translator'];
            $this->customer = $post_obj['customer'];
            $this->origin_lang = $post_obj['origin'];
            $this->translate_lang = $post_obj['translate'];
            $this->text_to_translate = $post_obj['text_to_translate'];
            $this->deadline = $post_obj['date_of_deadline'];

            $this->cardOrder = JsonAction::readJSON('card_order');
            $this->origin_text = JsonAction::readJSON('original_text');
            $this->translate_text = JsonAction::readJSON('translate_text');
        }
    }

    /**
     * Создаёт и возвращает карточку с данными по заказу на перевод
     * @param string если null генерируется случайный номер, иначе пишет переданный номер 
     */
    private function createNewOrder (string $id = null) : array
    {   
        $card_id = Generate::getUniqId('order_');
        $user_array = [
            'status' => 'new',
            'translator' => $this->executor,
            'customer' => $this->customer,
            'lang_origin_text' => $this->origin_lang,
            'lang_for_translate' => $this->translate_lang,
            'deadline' => $this->deadline
        ];
 
        $this->id_text = $card_id;
        if($id) {
            return $user_array;
        } else {
            $json[$card_id] = $user_array;
            return $json;
        }
    }

    /**
     * Создаёт и возвращает карточку на оригинальный текст
     */
    private function createOriginTextCart(string $id = null) : array
    {
        $origin_text_array = [
            'status' => 'new',
            'text' => $this->text_to_translate
        ];
        if($id) {
            return $origin_text_array;
        }
        $json[$this->id_text] = $origin_text_array;
        return $json;
    }

    /**
     * Создаёт и возвращает карточку на переведённый текст
     */
    private function createTranslateTextCart(string $id = null) : array
    {
        $origin_text_array = [
            'status' => 'new'
        ];
        foreach($this->translate_lang as $value) {
            $origin_text_array += [$value=> ''];
        }
        if($id) {
            return $origin_text_array;
        }
        $json[$this->id_text] = $origin_text_array;
        return $json;
    }

    /**
     * Запускает создание и запись карочек в базу и добавляет переводчику 
     * @param string если null пишет в базу с случайным номером, иначе перезаписывает сущестующую запись в базе
     */
    public function setTextComplete(string $id = null) : void
    {
        $cardOrder = $this->cardOrder;
        $origin_text = $this->origin_text;
        $translate_text = $this->translate_text;
        $users = $cardOrder[$id]['translator'];

        if($id) {
            $cardOrder[$id] = $this->createNewOrder($id);
            $origin_text[$id] = $this->createOriginTextCart($id);
            $translate_text[$id] = $this->createTranslateTextCart($id);


            User::deleteCardId($users, $id);
            User::writeIdToTranslater($this->executor, $id);
        }
         else {
            $cardOrder += $this->createNewOrder();
            $origin_text += $this->createOriginTextCart();
            $translate_text += $this->createTranslateTextCart();
            User::writeIdToTranslater($this->executor, $this->id_text);
        }
        JsonAction::setJsonFile($cardOrder, 'card_order');
        JsonAction::setJsonFile($origin_text, 'original_text');
        JsonAction::setJsonFile($translate_text, 'translate_text');
    }
}