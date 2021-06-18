<?php

$title = "Multiplicorne - Accueil";
$js = "";

ob_start(); ?>
<section class="content__racesIndex">
  <div class="content__racesIndex__intel">

    <h1 id='titre_index'>Bonjour 
      <?php if (isset($_SESSION['pseudo'])) {
        $pseudo = htmlspecialchars($_SESSION['pseudo']);
        echo htmlspecialchars($_SESSION['pseudo']);
      } else {
        $_SESSION['pseudo'] = "visiteur ou visiteuse ";
        echo htmlspecialchars($_SESSION['pseudo']);
      }
    ?>, prêt.e pour faire la course ?</h1>

    <h3>Quelques informations pour commencer :</h3>

    <ul>
        <li>En choisissant un "Sprint" la course dure le temps de 10 opérations.</li>
        <li>Avec "Marathon" ce sont toutes les tables du 2 au 9, ou alors 80 opérations d'additions et soustractions mélangées, qu'il faudra résoudre pour arriver à la fin.</li>
        <li>Tu peux enregistrer tes temps, si tu as créé un compte ils sont enregistrés avec ton nom !</li>
        <li>Si tu as créé un compte tu peux changer de personnage et de décor depuis les paramètres de ton compte (en haut à droite).</li>
    </ul>
    
  </div>
</section>
<?php $content = ob_get_clean();
require('./view/template.php');
?>
