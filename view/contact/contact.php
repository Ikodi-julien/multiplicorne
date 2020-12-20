<?php
$title = "Multiplicorne - Contact";
$js = null;
ob_start(); ?>

<section class="contact">
    <h2>Laisser un message au webmaster :</h2>
    <div class="contact__sep"></div>
    <form action="./index.php?info_login=contactEmail" method="post">
        <label for="name">Ton nom</label>
        <input type="text" name="name" id="name">
        <br />
        <label for="email">Ton email</label>
        <input type="email" name="email" id="email">
        <br />
        <label for="message">Ton message</label>
        <br />
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <br />
        <button type="submit">Envoyer</button>
    </form>
</section>

<?php $content = ob_get_clean();
require("./view/template.php"); ?>