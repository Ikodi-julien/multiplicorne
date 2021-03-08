<?php 
$title = 'Multiplicorne - Temps';
$js = '';

ob_start();
?>
    <section class="userTimes">
    <h1> Temps de <?php echo $pseudo; ?></h1>

    <?php 
    $races = ['Toutes', '9', '8', '7', '6', '5', '4', '3', '2'];
    
    for ($index = 0; $index< count($races) - 1; $index++) { 
        
    $times = rqTenLastTimes($pseudo, $races[$index]);
    echo 'ok 3';
    // $bestTime = rqBestTime($pseudo, $races[$index]);
    echo 'ok 4';
    // $dataBestTime = $bestTime->fetch(PDO::FETCH_ASSOC);
    echo 'ok 5';
    
    // if ($dataBestTime['table_multiplication'] !== null) {
        
    //     if ($dataBestTime['table_multiplication'] === 'Toutes ') {
    //         $dataBestTime['table_multiplication'] = "Le Marathon !";
    //     }
        
    // echo '<h2>Table : '.$dataBestTime['table_multiplication']. '</h2><br />';
    // echo '<h3>Meilleur temps : '.$dataBestTime['best_time'].' le ' . $dataBestTime['date_course']. '</h3><br />';
    // }
        
        while ($data = $times->fetch()) {
            
        echo '<p>' . $data['melange'].' en '.$data['temps_course']. ' le '. $data['date_course'].'</p><br />';
            
        }
    }
    ?>

    </section>
<?php
$content = ob_get_clean();
require('./view/template.php');
?>