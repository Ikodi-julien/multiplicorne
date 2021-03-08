<?php 
$title = 'Multiplicorne - Temps';
$js = '';

ob_start();
?>
    <section class="userTimes">
    <h1> Temps de <?php echo $pseudo; ?></h1>

    <?php 
    $races = ['Toutes', '9', '8', '7', '6', '5', '4', '3', '2'];
    
    for ($index = 0; $index< count($races) ; $index++) { 
        
    $times = rqTenLastTimes($pseudo, $races[$index]);
    // echo 'ok 3';
    $bestTime = rqBestTime($pseudo, $races[$index]);
    // echo 'ok 4';
    
    if ($bestTime) {
        
        echo '<h2>Table : '.$races[$index]. '</h2>';
            
        if ($bestTime['table_multiplication'] === 'Toutes ') {
            $bestTime['table_multiplication'] = "Le Marathon !";
            
        }
        
        $bestTimeString = floor($bestTime['temps_course'] / 60) . 'mn ' .  floor($bestTime['temps_course'] % 60) . 's ';

        echo '<h3>Meilleur temps : '. $bestTimeString . $bestTime['date_course']. '</h3>';
        
        while ($data = $times->fetch()) { 
            
            if (floor($data['temps_course'] / 60)) {
                $timeToString = floor($data['temps_course'] / 60) . 'mn ' .  floor($data['temps_course'] % 60) . 's ';
            } else {
                $timeToString = floor($data['temps_course'] % 60) . 's ';
            }
        ?>
            
    <p><?= $timeToString ?>, <?=$data['date_course'] ?>, <?= $data['melange'] ?></p>
            
       <?php }
    }
    }
    
    ?>

    </section>
<?php
$content = ob_get_clean();
require('./view/template.php');
?>