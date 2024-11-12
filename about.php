<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/apropos.png" alt="">
      </div>

      <div class="content">
         <h3>À quoi sert cette platform?</h3>
         <p>Cette plateforme est dédié aux étudiants de FSJES Ain Sebaa, afin que les étudiants pouvoir profiter des formations à distance publier par leur professeur.</p>
         <a href="courses.php" class="inline-btn">Nos formations</a>
      </div>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3>+100</h3>
            <span>Formation en ligne</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3>+14000</h3>
            <span>Etudiants</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3>+94</h3>
            <span>Enseignant</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-briefcase"></i>
         <div>
            <h3>4</h3>
            <span>Départements</span>
         </div>
      </div>

   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
   
</body>
</html>