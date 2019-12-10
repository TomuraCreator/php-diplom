<?php
include "header.php";
include "autoload.php";

$adress_to_route = 'redirection.php';

$textGenerate = new TextGenerate($_SESSION); 

$get_filter = (!empty($_GET['filter'])) ? $_GET['filter'] : 'all';

?>

<section class="section">
    <?php echo $textGenerate->generateCard($get_filter, $adress_to_route) ?>
<div class="wrapper_form_create deactivate">
    <form action="<?php echo $adress_to_route . '?name=new_order'?>" method="POST" class="create_order_form">
        <div class="wrapper_personality_or_client">
            <div class="text_window order_person">
                <p>Исполнитель:</p>
                <select name="selected_translator" class="selected_translator">
                    <?php echo $textGenerate->generateUserPoint() ?>
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

<?php 
if(!empty($_GET['name'])) {
    if($_GET['name'] == 'edit_card') {
        echo $textGenerate->getEditForm($_GET['id']);
    }
}
?>

</section>
<script src="src/script/header.js">
</script>
