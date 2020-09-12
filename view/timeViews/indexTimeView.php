<?php 
$title = 'Temps';
$css = './css/style.css';
$js = '';

ob_start();
?>
    <section class="userTimes">
    <h1> Temps toutes tables mélangées de <?php echo $pseudo; ?></h1>

    <?php displayTimes($rqTimes); ?>

    </section>
<?php
$content = ob_get_clean();
require('./view/timeViews/templateTime.php');
?>