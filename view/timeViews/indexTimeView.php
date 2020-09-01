<?php 
$title = 'Temps';
$css = './css/base.css';
$js = '';

ob_start();
?>
    <section id=stats>
    <h1> Temps toutes tables mélangées de <?php echo $pseudo; ?></h1>

    <?php displayTimes($rqTimes); ?>

    </section>
<?php
$content = ob_get_clean();
require('./view/raceViews/templateRace.php');
?>