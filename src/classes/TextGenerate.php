<?php 
/**
 * создаёт объект для генерации HTML 
 * @param array $user данные из сессии
 */
class TextGenerate 
{
    private $text_json;
    private $only_text_json;
    private $text_user_now;
    private $user;
    private $user_login;
    private $translators;
    private $translate_text;
    private $isTranslator = false;

    
    function __construct($user = null)
    {
        if($user) {
            $this->user = $user['user'];
            $this->user_login = $user['login'];
            $this->text_json = JsonAction::readJSON('card_order');
            $this->only_text_json = JsonAction::readJSON('original_text');
            $this->translate_text = JsonAction::readJSON('translate_text');
            $this->translators = JsonAction::readJSON();

            if($this->user['group'] == 'translator') {
                $this->text_user_now = array_merge(
                    $this->user['during_translation'], 
                    $this->user['translated']
                );
                $this->isTranslator = true;
            } else {
                $this->text_user_now = [];
                foreach($this->text_json as $header=>$value) {
                    $this->text_user_now[] = $header;
                }
            }
        }

    }

    /**
     * Генерирует карточку с заказом от менеджера 
     * @param $status статус GET запроса фильтра 
     * @return строка HTML
     */
    public function generateCard(string $status, $adress_to_route) : string
    {
        $only_text_json = $this->only_text_json;

        $arrayOfHtml = [];

        foreach($this->text_user_now as $val): 
            $value = $this->text_json[$val];
            $strimwidth = mb_strimwidth($only_text_json[$val]['text'], 0, 300, "...", mb_internal_encoding());
            $hrefEdit = 'body.php?name=edit_card&id=' . $val;
            $hrefDelete = $adress_to_route . '?name=delete_card&id=' . $val;
            $hrefShow = 'body.php?name=show_card&id=' . $val;
            $stringOflang = join($value['lang_for_translate'], ' ');
            $statusText = $only_text_json[$val]['status'];

            $deleteText = <<<DOC
                <a class="button_delete_quest" href="$hrefDelete" title="удалить">
                    <img src="src/image/174-bin2.png" alt="удалить">
                </a>
DOC;
            $editText = <<<DOC
            <a class="button_edit" href="$hrefEdit" title="редактировать">
                <img src="src/image/006-pencil.png" alt="редактировать" >
            </a>
DOC;
            $modal_show_card = <<<DOC
            <a class="button_edit" href="$hrefShow" title="просмотреть">
                <img src="src/image/207-eye.png" alt="просмотреть" >
            </a>
DOC;
            $deleteButtonVisible = ($this->isTranslator) ? $modal_show_card : $deleteText . $modal_show_card;
            $editButtonVisible = ($this->isTranslator) ? $editText : '';


            if($value['status'] === $status):
                $arrayOfHtml[] = <<< HTML
                <article class="article {$statusText}"> 
                    <div class="wrapper_order_text">
                        <p class="text_overflow">
                            $strimwidth
                        </p>
                        <div class="wrapper_meta_date">
                            <div class="wrapper_rule_button">
                                $editButtonVisible
                                $deleteButtonVisible
                            </div>
                            <div class="deadline_quest">{$value['deadline']}</div>
                            <div class="lang">
                                $stringOflang
                            </div>
                        </div>
                    </div>
                </article>
HTML;
            elseif($status === 'all'):
                $arrayOfHtml[] = <<< HTML
                <article class="article {$statusText}"> 
                    <div class="wrapper_order_text">
                        <p class="text_overflow">
                            $strimwidth
                        </p>
                        <div class="wrapper_meta_date">
                            <div class="wrapper_rule_button">
                                $editButtonVisible  
                                $deleteButtonVisible
                            </div>
                            <div class="deadline_quest">{$value['deadline']}</div>
                            <div class="lang">
                                $stringOflang
                            </div>
                        </div>
                    </div>
                </article>
HTML;
            endif; //конец if
        endforeach; // конец foreach

        return join($arrayOfHtml);
    }

    /**
     * Генерирует строку HTML со списком переводчиков
     * @return string
     */
    public function generateUserPoint() : string 
    {
        $array_option = [];
        foreach($this->translators['users'] as $person_code => $person_obj)
        {
            $t = '';
            if($person_obj['group'] === 'translator') {
                $t .= "<option value=";
                $t .= '' . $person_code . '';
                $t .= ">" . $person_obj['name'] . ' ' . $person_obj['second_name']
                . '(' . $person_obj['count_congestion'] . ')';
                $t .= "</option>";
                array_push($array_option, $t);
            }   
        }
        return join($array_option);
    }

    /**
     * генерирует форму для измененения / добавления переведённого текста после перевода или исправлении карточки 
     * @param string id задания на перевод
     * @return string строка HTML 
     */
    public function getEditForm(string $card_id) 
    {
        if($card_id) {
            $path = 'redirection.php?name=edit_card';
            $card_text = $this->text_json[$card_id];
            $only_text_json = $this->only_text_json[$card_id];

            $arrFieldToTranslated = '';
            foreach($card_text['lang_for_translate'] as $lang) {
                $placeholder = $this->translateLangToStr($lang);
                $arrFieldToTranslated .= <<<ED
                <textarea name="$lang" cols="30" rows="10" class="text_of_translate" required placeholder="$placeholder" title="$placeholder"></textarea>
ED;
            }

            return <<<DOCS
            <div class="wrapper_form_edit">
                <form action="{$path}" method="POST" class="edit_form">
                    <div class="wrapper_personality_or_client">
                        <div class="text_window order_person">
                            <div class="lang_tab">
                                <p>Язык оригинала: 
                                {$this->translateLangToStr($card_text['lang_origin_text'])}
                                </p>
                                <p>Язык перевода:
                                {$this->translateLangToStr($card_text['lang_for_translate'])}
                                </p>
                            </div>
                        </div>
                        <div class="text_window translate_person">
                            <p>Срок сдачи: {$card_text['deadline']}</p>
                        </div>
                    </div>
                    <div class="original_text_show">
                        {$only_text_json['text']}
                    </div>
                    <input type="hidden" name="login" value="$this->user_login">
                    <input type="hidden" name="card_id" value="$card_id">
                    $arrFieldToTranslated
                    <div class="wrapper_submit">
                        <div class="wrapper_button_forms">
                            <input type="submit" value="Отправить">
                            <input type="button" value="Закрыть" class="close">
                        </div>
                    </div>
                </form>
            </div>
DOCS;
        }
    }

    /**
     * Генерирует страницу просмотра перевода
     * @param string id задания на перевод
     * @return string строка HTML   
     */
    public function getShowForm(string $card_id) : string
    {   
        if($card_id) {
            $path = 'redirection.php?name=show_card';
            $card_text = $this->text_json[$card_id];
            $only_text_json = $this->only_text_json[$card_id];
            $translate_text = $this->translate_text[$card_id];
            $confirm_button = ($this->isTranslator) ? '' : <<<DOC
            <div class="wrapper_button_forms">
                <input type="submit" value="Выполнено" name="confirm" class="status_button confirm_work">
                <input type="submit" value="Отклонено" name="rifiutare" class="status_button rifiutare_work">
            </div>
DOC;

            $arrFieldToTranslated = '';
            foreach($card_text['lang_for_translate'] as $lang) {
                $placeholder = $this->translateLangToStr($lang);
                $arrFieldToTranslated .= <<<DOC
                <div class="translate_text_show" title="$placeholder">
                    {$translate_text[$lang]}
                </div>
DOC;
            }
            return <<<DOC
            <div class="wrapper_form_edit">
                <form action="{$path}" method="POST" class="edit_form show_form">
                    <div class="wrapper_personality_or_client">
                        <div class="text_window order_person">
                            <div class="lang_tab">
                                <p>Язык оригинала: 
                                {$this->translateLangToStr($card_text['lang_origin_text'])}
                                </p>
                                <p>Язык перевода:
                                {$this->translateLangToStr($card_text['lang_for_translate'])}
                                </p>
                            </div>
                        </div>
                        <div class="text_window translate_person">
                            <p>Срок сдачи: {$card_text['deadline']}</p>
                        </div>
                    </div>
                    <div class="original_text_show">
                        {$only_text_json['text']}
                    </div>
                    <input type="hidden" name="login" value="$this->user_login">
                    <input type="hidden" name="card_id" value="$card_id">
                        $arrFieldToTranslated
                    <div class="wrapper_submit">
                        <div class="wrapper_button_forms">
                            <input type="button" value="Закрыть" class="close">
                        </div>
                        $confirm_button
                    </div>
                </form>
            </div>
DOC;
        }
    }
    /**
     * Переводит сокращения языков в полный вид
     * @param $str принимает строку или индексный массив
     */
    public function translateLangToStr($str = null)
    {
        $transpiller = function( $string)
        {
            switch($string) {
                case 'eng':
                    return 'английский';
                    break;
                case 'deu':
                    return 'немецкий';
                    break;
                case 'rus':
                    return 'русский';
                    break;
                case 'fra':
                    return 'французский';
                    break;
                case 'it':
                    return 'итальянский';
                    break;
                case 'esp':
                    return 'испанский';
                    break;
            }
        };
        if(is_string($str)) {
            return $transpiller($str);
        } else {
            $est = array_map($transpiller, $str);
            $filter = join(', ', $est);
            return $filter;
        }
    }   
}