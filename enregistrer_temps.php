<?php session_start();?>
<?php
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
} else {
    $page = 'page_toutes_tables.php';
}
// On vérifie si les infos sont remplies
if ($_GET['temps'] != null) {
    // On fait gaffe aux valeurs fournies
    $pseudo = htmlspecialchars($_SESSION['pseudo']);
    $temps = htmlspecialchars($_GET['temps']);
    $table = htmlspecialchars($_GET['table_multiplication']);
    $melange = htmlspecialchars($_GET['melange']);

    // On se connecte à la base de donnée
    include("./blocs/connexion_bdd.php");

    // Ecrire les infos dans la bdd,
    $req = $bdd->prepare("INSERT INTO course_multiplication(id_coureur, table_multiplication, melange, temps_course) 
    VALUES (:id_coureur, :table_multiplication, :melange, :temps_course)");

    $req->execute(array(
        'id_coureur' => $pseudo,
        'table_multiplication' => $table,
        'melange' => $melange,
        'temps_course' => $temps,
    ));

    // Retour à la page course
    $_SESSION['enregistrement'] = 'Temps enregistré';
    header('Location: '.$page);
} else {
    // Rediriger vers la course, indiquer que problème.
    $_SESSION['enregistrement'] = 'Problème d\'enregistrement';
    header('Location: '.$page);
}
?>