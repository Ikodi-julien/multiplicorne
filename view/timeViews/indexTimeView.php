<?php 
$title = 'Temps';
$js = '';

ob_start();
?>
    <section class="userTimes">
    <h1> Temps de <?php echo $pseudo; ?></h1>

    <?php displayTimes($rqTimes); ?>

    </section>
<?php
$content = ob_get_clean();
require('./view/template.php');
?>