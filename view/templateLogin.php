<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <section class="accueil">

    <h1 id='titre_login' >Les multiplications, ça fait avancer les licornes !</h1>

        <div id="loginbox">
          <div class="logo">
              <img src="./images/licorne-detouree.png" alt="licorne... sisi !">
          </div>
          <div class="login">
            <?php echo $content; ?>
          </div>
        </div>
    </section>
</body>
</html>