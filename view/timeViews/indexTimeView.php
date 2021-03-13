<?php 
$title = 'Multiplicorne - Temps';
$js = '';

ob_start();
?>
    <section class="userTimes">
    <h1 class="userTimes__bigTitle"> Temps de <?php echo $pseudo; ?></h1>

    <div class="userTimes__container">
    
        <div class="userTimes__container__section">
    
    <?php
    //Ensuite afficher les résultats des sprints s'il y en a
    if ($multipliSprintCount > 0) { ?>
    
        <div class="userTimes__container__raceType">
    
        <!-- Afficher le titre -->
        <h2 class="userTimes__raceTypeTitle">Sprint Multiplications</h2>
        
        <?php
        
        foreach($allMultipliSprint as $index => $tableSprints) { 
            
            // On affiche si il y a quelque chose
            if (isset($tableSprints[0]['table_multiplication'])) {
            ?>
                
                <h3 class="userTimes__table">Table du <?= $tableSprints[0]['table_multiplication']; ?></h3>
                
                <!-- Affichage du meilleur temps -->
                <h3 class="userTimes__bestTime">
                    Meilleur temps: <?= floor($tableSprints['best_time']['temps_course'] / 60); ?>mn 
                    <?= $tableSprints['best_time']['temps_course'] % 60; ?>s 
                    <?= $tableSprints['best_time']['date_course']; ?>
                </h3>
                
                <!-- Afficher les 10 derniers temps -->
            <?php
                for ($index = 0; $index < 10; $index++) { 
                    
                    if (isset($tableSprints[$index])) {
                    ?>

                    <p class="userTimes__time">
                        <?= floor($tableSprints[$index]['temps_course'] / 60); ?>mn 
                        <?= $tableSprints[$index]['temps_course'] % 60; ?>s 
                        <?= $tableSprints[$index]['date_course']; ?>
                    </p>
                    
                <?php 
                    }
                }
            }
        } ?>
        </div>
        <?php } ?>
    </div>
    <!-- fin de section sprint multipli -->
    
    
    
    <div class="userTimes__container__section">
    <!-- Déjà afficher les résultats des marathons s'il y en a  -->
    <?php
    if ($multipliMarathonCount > 0) { ?>
            
        <div class="userTimes__container__raceType">
        
        <!-- Pour le marathon multipli, afficher le titre -->
        <h2 class="userTimes__raceTypeTitle">Marathon des Multiplications</h2>
        <!-- le meilleur temps -->
        <h3 class="userTimes__bestTime">Meilleur temps : 
            <?= floor($bestMultipliMarathon['temps_course'] / 60); ?>mn 
            <?= $bestMultipliMarathon['temps_course'] % 60; ?>s 
            <?= $bestMultipliMarathon['date_course']; ?>
        </h3>
        
        <!-- Pour le marathon multipli, afficher les 10 derniers temps s'il y en a -->
        <?php 
            foreach ($multipliMarathonTimes as $index => $race) {  ?>
         <p class="userTimes__time">
            <?= floor($race['temps_course'] / 60); ?>mn 
            <?= $race['temps_course'] % 60; ?>s 
            <?= $race['date_course']; ?>
        </p>
        
        <?php }  ?>
        
        </div>
    
        <?php
    } 
        
    if ($addSubMarathonCount > 0) { ?>
        
        <div class="userTimes__container__raceType">
        
        <!-- Pour le marathon add_sub, afficher le titre -->
        <h2 class="userTimes__raceTypeTitle">Marathon des Additions et Soustractions</h2>
        <!-- le meilleur temps -->
        <h3 class="userTimes__bestTime">Meilleur temps : 
            <?= floor($bestAddSubMarathon['temps_course'] / 60); ?>mn 
            <?= $bestAddSubMarathon['temps_course'] % 60; ?>s 
            <?= $bestAddSubMarathon['date_course']; ?>
        </h3>

        <!-- Pour le marathon add_sub, afficher les 10 derniers temps s'il y en a -->
        <?php 
            foreach ($addSubMarathonTimes as $index => $race) {  ?>
         <p class="userTimes__time">
            <?= floor($race['temps_course'] / 60); ?>mn 
            <?= $race['temps_course'] % 60; ?>s 
            <?= $race['date_course']; ?>
        </p>
        <?php } ?>
        </div>
        
        
    <?php } ?>
    <!-- </div> -->
    <!-- fin de section marathon -->

    <!-- <div class="userTimes__container__section"> -->
    
        <?php
    
    
    if ($addSprintCount > 0) { ?>
            
        <div class="userTimes__container__raceType">
        
        <!-- Pour sprint add, afficher le titre -->
        <h2 class="userTimes__raceTypeTitle">Sprint Additions</h2>
        <!-- le meilleur temps -->
        <h3 class="userTimes__bestTime">Meilleur temps : 
            <?= floor($bestAddSprint['temps_course'] / 60); ?>mn 
            <?= $bestAddSprint['temps_course'] % 60; ?>s 
            <?= $bestAddSprint['date_course']; ?>
        </h3>

        <!-- Pour le sprint add, afficher les 10 derniers temps s'il y en a -->
        <?php 
            foreach ($addSprintTimes as $index => $race) {  ?>
         <p class="userTimes__time">
            <?= floor($race['temps_course'] / 60); ?>mn 
            <?= $race['temps_course'] % 60; ?>s 
            <?= $race['date_course']; ?>
        </p>
    <?php } ?>
            </div>
    <?php
    }
        
    if ($subSprintCount > 0) { ?>
        
        <div class="userTimes__container__raceType">
            
            <!-- Pour le sprint sub, afficher le titre -->
            <h2 class="userTimes__raceTypeTitle">Sprint Soustractions</h2>
            <!-- le meilleur temps -->
            <h3 class="userTimes__bestTime">Meilleur temps : 
                <?= floor($bestSubSprint['temps_course'] / 60); ?>mn 
                <?= $bestSubSprint['temps_course'] % 60; ?>s 
                <?= $bestSubSprint['date_course']; ?>
            </h3>

            <!-- Pour le marathon add_sub, afficher les 10 derniers temps s'il y en a -->
            <?php 
                foreach ($subSprintTimes as $index => $race) {  ?>
            <p class="userTimes__time">
                <?= floor($race['temps_course'] / 60); ?>mn 
                <?= $race['temps_course'] % 60; ?>s 
                <?= $race['date_course']; ?>
            </p>
        <?php } ?>
                </div>
    <?php } ?>

            </div>
            <!-- fin de section sprint add et sub -->
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
require('./view/template.php');