<?php
include "header.php";
include "autoload.php";

$adress_to_route = 'redirection.php';

$textGenerate = new TextGenerate($_SESSION); 


User::reloadStatTranslator();
User::reloadStateUsersCategory();
$get_filter = (!empty($_GET['filter'])) ? $_GET['filter'] : 'all';
// $get_name = (!empty($_GET['name'])) ? $_GET['name'] : null;
?>

<section class="section">
    <?php echo $textGenerate->generateCard($get_filter, $adress_to_route) ?>
<?php 
if(!empty($_GET['name'])) {
    if($_GET['name'] == 'edit_card') {
        echo $textGenerate->getEditForm($_GET['id']);
    } elseif($_GET['name'] == 'show_card') {
        echo $textGenerate->getShowForm($_GET['id']);
    } elseif($_GET['name'] == 'manager_edit_card') {
        echo $textGenerate->getNewTaskForm($_GET['id']);
    } elseif($_GET['name'] == 'make_new_task') {
        echo $textGenerate->getNewTaskForm();
    }
}
?>

</section>
<script src="src/script/header.js">
</script>
