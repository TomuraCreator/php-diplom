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

    function __construct($post_obj)
    {
    $this->executor = $post_obj['selected_translator'];
    $this->customer = $post_obj['customer'];
    $this->origin_lang = $post_obj['origin'];
    $this->translate_lang = $post_obj['translate'];
    $this->text_to_translate = $post_obj['text_to_translate'];
    $this->deadline = $post_obj['date_of_deadline'];
    }

    /**
     * Создаёт и возвращает карточку с данными по заказу на перевод
     */
    private function createNewOrder () : array
    {   
        $id = Generate::getUniqId('order_');
        $user_array[$id] = [
            'status' => 'new',
            'translator' => $this->executor,
            'customer' => $this->customer,
            'lang_origin_text' => $this->origin_lang,
            'lang_for_translate' => $this->translate_lang,
            'deadline' => $this->deadline
        ];
        $this->id_text = $id;
        return $user_array;
    }

    /**
     * Создаёт и возвращает карточку на оригинальный текст
     */
    private function createOriginTextCart() : array
    {

        $origin_text_array[$this->id_text] = [
            'status' => 'new',
            'text' => $this->text_to_translate
        ];
        return $origin_text_array;
    }

    /**
     * Создаёт и возвращает карточку на переведённый текст
     */
    private function createTranslateTextCart() : array
    {
        $origin_text_array[$this->id_text] = [
            'status' => 'new'
        ];
        foreach($this->translate_lang as $value) {
            $origin_text_array[$this->id_text] += [$value=> '' ];
        }
        return $origin_text_array;
    }

    /**
     * Запускает создание и запись карочек в базу и добавляет переводчику 
     */
    public function setTextComplete() : bool
    {
        $cardOrder = JsonAction::readJSON('card_order');
        $origin_text = JsonAction::readJSON('original_text');
        $translate_text = JsonAction::readJSON('translate_text');

        $cardOrder += $this->createNewOrder();
        $origin_text += $this->createOriginTextCart();
        $translate_text += $this->createTranslateTextCart();

        if (
            JsonAction::setJsonFile($cardOrder, 'card_order') &&
            JsonAction::setJsonFile($origin_text, 'original_text') &&
            JsonAction::setJsonFile($translate_text, 'translate_text')
        ) {
            User::writeIdToTranslater($this->executor, $this->id_text);
            return true;
        } 
        return false;
    }
}