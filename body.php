<?php
include "header.php";
include "autoload.php";

$user = $_SESSION['user'];
$text_json = JsonAction::readJSON('card_order');
$only_text_json = JsonAction::readJSON('original_text');
User::reloadStatTranslator();
if($user && $user['group'] == 'translator') {
    $text_user_now = array_merge($user['during_translation'], $user['translated']);
} else {
    $text_user_now = [];
    foreach($text_json as $header=>$value) {
        $text_user_now[] = $header;
    }
}
$translators = JsonAction::readJSON();
$array_option = [];
$get_filter = (!empty($_GET['filter'])) ? $_GET['filter'] : 'all';
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
<?php foreach($text_user_now as $val): ?>
    <?php $value = $text_json[$val] ?>
    <?php if($value['status'] === $get_filter): ?>
        <article class="article"> 
            <div class="wrapper_order_text">
                <p class="text_overflow">
                    <?php echo mb_strimwidth($only_text_json[$val]['text'], 0, 300, "...", mb_internal_encoding())?>
                </p>
                <div class="wrapper_meta_date">
                    <div class="wrapper_rule_button">
                        <div class="button_edit" data-id="<?php echo $val ?>">
                            <img src="src/image/006-pencil.png" alt="редактировать" >
                        </div>
                        <div class="button_delete_quest">
                            <img src="src/image/174-bin2.png" alt="удалить">
                        </div>
                    </div>
                    <div class="deadline_quest"><?php echo $value['deadline'] ?></div>
                    <div class="lang">
                        <?php foreach($value['lang_for_translate'] as $prop) {
                            echo $prop . ' ';
                        } ?>
                    </div>
                </div>
            </div>
        </article>
    <?php elseif($get_filter === 'all'):?>
        <article class="article"> 
            <div class="wrapper_order_text">
                <p class="text_overflow">
                    <?php echo mb_strimwidth($only_text_json[$val]['text'], 0, 300, "...", mb_internal_encoding())?>
                </p>
                <div class="wrapper_meta_date">
                    <div class="wrapper_rule_button">
                        <div class="button_edit " data-id="<?php echo $val ?>">
                            <img src="src/image/006-pencil.png" alt="редактировать">
                        </div>
                        <div class="button_delete_quest">
                            <img src="src/image/174-bin2.png" alt="удалить">
                        </div>
                    </div>
                    <div class="deadline_quest"><?php echo $value['deadline'] ?></div>
                    <div class="lang">
                        <?php foreach($value['lang_for_translate'] as $prop) {
                            echo $prop . ' ';
                        } ?>
                    </div>
                </div>
            </div>
        </article>
    <?php endif ?>
<?php endforeach ?>
<div class="wrapper_form_create deactivate">
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
            <div class="wrapper_button_forms">
                <input type="submit" value="Опубликовать">
                <input type="button" value="Закрыть" class="close">
            </div>
            <div class="wrapper_deadline">
                <p>Завершить до: </p>
                <input type="date" name="date_of_deadline" required>
            </div>
        </div>
        
    </form>
</div>

<!-- <div class="wrapper_form_edit">
    <form action="translate_form.php" method="POST" class="edit_form">
        <div class="wrapper_personality_or_client">
            <div class="text_window order_person">
                <div class="lang_tab">
                    <p>Язык оригинала:</p>
                    <p>Язык перевода:</p>
                </div>
            </div>
            <div class="text_window translate_person">
                <p>Срок сдачи:</p>
            </div>
        </div>
        <div class="original_text_show">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam facere cumque provident minima optio doloribus ipsum amet consectetur impedit at harum sunt atque odit corrupti ducimus quidem rem dicta, animi enim, aspernatur omnis sint, delectus ea? Tempore illum, dolorum animi perspiciatis, ducimus cum fugit, officia ratione qui sapiente labore eius reprehenderit. Molestiae voluptate cupiditate dolorem, temporibus, placeat eligendi, laudantium vitae omnis consequuntur veritatis earum reprehenderit? Exercitationem doloremque velit delectus nam libero id facilis reiciendis eos laborum nostrum, ex alias repellat, amet magni, accusantium maiores quos? Nesciunt possimus voluptas, voluptates iure assumenda labore autem dolores? Quasi ut repudiandae temporibus modi illum.
        </div>
        <textarea name="" cols="30" rows="10" class="text_of_translate" required placeholder="" title="sdsd">
        </textarea>
        <div class="wrapper_submit">
            <div class="wrapper_button_forms">
                <input type="submit" value="Отправить">
                <input type="button" value="Закрыть" class="close">
            </div>
        </div>
    </form>
</div> -->

</section>
<script src="src/script/header.js"></script>