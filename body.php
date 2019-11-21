<?php
include "header.php";
$text_make = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore harum fuga incidunt molestias rerum laboriosam officia modi debitis non quaerat facere molestiae deleniti quam velit, quo sed, ut quia qui! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima qui totam nihil aliquid, quas dicta, praesentium nisi obcaecati numquam consequatur commodi veniam reiciendis molestias natus eius tenetur? Hic quasi quos rem voluptate at id placeat ducimus veniam, suscipit mollitia molestiae provident incidunt inventore cum ut nobis reprehenderit nam deserunt, et eveniet illo obcaecati! Sed expedita a dicta impedit laudantium sunt debitis provident totam ex maxime officiis, libero consequatur aperiam voluptate possimus ad explicabo corporis perferendis pariatur doloribus blanditiis. Deleniti tempora quod quis eos omnis id ullam eum corporis veritatis repellendus nostrum, necessitatibus, odit deserunt temporibus corrupti beatae maxime soluta iste.';
$lang_array = ['it', 'eng', 'fr', 'deu', 'chi', 'jap'];
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
    <form action="" class="create_order_form">
        <div class="wrapper_personality_or_client">
            <div>
                <p>исполнитель:</p>
                <input type="text" name="executor">
            </div>
            <div>
                <p>заказчик:</p>
                <input type="text" name="order">
            </div>
        </div>
        <div class="wrapper_radio_origin">
            <input type="radio" name="origin_russian" id="rus">
            <label for="rus">Русский</label>
            <input type="radio" name="origin_english" id="eng">
            <label for="rus">Английский</label>
            <input type="radio" name="origin_deutch" id="deu">
            <label for="rus">Немецкий</label>
            <input type="radio" name="origin_france" id="fra">
            <label for="rus">Французский</label>
            <input type="radio" name="origin_italian" id="it">
            <label for="rus">Итальянский</label>
            <input type="radio" name="origin_espana" id="esp">
            <label for="rus">Испанский</label>
        </div>
        <div class="wrapper_radio_translate">
            <input type="radio" name="translate_russian" id="rus">
            <label for="rus">Русский</label>
            <input type="radio" name="translate_english" id="eng">
            <label for="rus">Английский</label>
            <input type="radio" name="translate_deutch" id="deu">
            <label for="rus">Немецкий</label>
            <input type="radio" name="translate_france" id="fra">
            <label for="rus">Французский</label>
            <input type="radio" name="translate_italian" id="it">
            <label for="rus">Итальянский</label>
            <input type="radio" name="translate_espana" id="esp">
            <label for="rus">Испанский</label>
        </div>
        <input type="text">
        <input type="text">
        <input type="text">
        <input type="text">
    </form>
</div>
</section>