<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $title; ?></title>
</head>
<body>
    <section class="login">

      <h1 class='login__title' >Les multiplications,<br /> ça fait avancer les licornes !</h1>

      <div class="login__box">

        <div class="login__logo">
            <img src="./images/licorne-detouree.png" alt="licorne... sisi !">
        </div>
        
        <div class="login__content">

          <?php echo $content; ?>
          
        </div>

      </div>

    </section>
</body>
</html>