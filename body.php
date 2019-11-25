<?php
include "header.php";
include "autoload.php";

$lang_array = ['it', 'eng', 'fr', 'deu', 'chi', 'jap'];
$translators = JsonAction::readJSON();
$array_option = [];

foreach($translators['users'] as $person_code => $person_obj) {
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
?>

<section class="section">
<!-- <?php for($i = 0; $i < 5; $i++): ?>
    
        <article class="article"> 
            <div class="wrapper_order_text">
                <p class="text_overflow">
                    <?php echo mb_strimwidth($text_make, 0, 400, "...", mb_internal_encoding())?>
                </p>
                <div class="wrapper_meta_date">
                    <div class="wrapper_rule_button">
                        <div class="button_edit">
                            <img src="src/image/006-pencil.png" alt="редактировать">
                        </div>
                        <div class="button_delete_quest">
                            <img src="src/image/174-bin2.png" alt="удалить">
                        </div>
                    </div>
                    <div class="deadline_quest">10/12/2019</div>
                    <div class="lang">
                        <?php foreach($lang_array as $value) {
                            echo $value . ' ';
                        } ?>
                    </div>
                </div>
            </div>
        </article>
    
<?php endfor ?> -->
<div class="wrapper_form_create">
    <form action="translate_form.php" method="POST" class="create_order_form">
        <div class="wrapper_personality_or_client">
            <div class="text_window order_person">
                <p>Исполнитель:</p>
                <select name="selected_translator" class="selected_translator">
                <?php foreach($array_option as $value) {
                    print $value;
                } ?> 
                </select>
            </div>
            <div class="text_window translate_person">
                <p>Заказчик:</p>
                <input type="text" name="customer" required>
            </div>
        </div>
        <div class="wrapper_checkbox_origin">
            <fieldset class="origin_text">
                <legend> Язык оригинала: </legend>
                <input type="radio" name="origin" value="rus" id="o_rus" >
                <label for="o_rus">Русский</label>
                <input type="radio" name="origin" value="eng" id="o_eng">
                <label for="o_eng">Английский</label> 
                <input type="radio" name="origin" value="deu" id="o_deu" checked>
                <label for="o_deu">Немецкий</label>
                <input type="radio" name="origin" value="fra" id="o_fra">
                <label for="o_fra">Французский</label>
                <input type="radio" name="origin" value="it" id="o_it">
                <label for="o_it">Итальянский</label>
                <input type="radio" name="origin" value="esp" id="o_esp">
                <label for="o_esp">Испанский</label>
            </fieldset>
        </div>
        <div class="wrapper_checkbox_translate">
            <fieldset class="translate_text">
                <legend>Язык перевода: </legend>
                <input type="checkbox" name="translate[]" value="rus" id="rus" checked>
                <label for="rus">Русский</label>
                <input type="checkbox" name="translate[]" value="eng" id="eng" checked>
                <label for="eng">Английский</label>
                <input type="checkbox" name="translate[]" value="deu" id="deu">
                <label for="deu">Немецкий</label>
                <input type="checkbox" name="translate[]" value="fra" id="fra">
                <label for="fra">Французский</label>
                <input type="checkbox" name="translate[]" value="it" id="it">
                <label for="it">Итальянский</label>
                <input type="checkbox" name="translate[]" value="esp" id="esp">
                <label for="esp">Испанский</label>
            </fieldset>    
            
        </div>
        <textarea name="text_to_translate" cols="30" rows="10" class="text_to_translate" required></textarea>
        <div class="wrapper_submit">
            <input type="submit" value="Опубликовать">  
            <div class="wrapper_deadline">
                <p>Завершить до: </p>
                <input type="date" name="date_of_deadline">
            </div>
        </div>
        
    </form>
</div>
</section>
