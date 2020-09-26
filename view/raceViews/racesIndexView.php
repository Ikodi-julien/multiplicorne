<?php

$title = "ACCUEIL";
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
    ?>, prêt(e) pour faire la course ?</h1>

    <h3>Quelques informations pour commencer :</h3>

    <ul>
        <li>En choisissant "Sprint" la course dure le temps d'une table de multiplication, tu peux choisir de la mélanger ou non.</li>
        <li>Avec "Marathon" ce sont toutes les tables du 2 au 9, dans le désordre, qu'il faudra résoudre pour arriver à la fin.</li>
        <li>Si tu as choisi un pseudo et un mot de passe, tu peux enregistrer tes temps et voir tes progrès !</li>
    </ul>
    
  </div>
</section>
<?php $content = ob_get_clean();
require('./view/template.php');
?>
