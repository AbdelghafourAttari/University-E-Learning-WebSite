<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>


<section class="quick-select">

   

   <div class="box-container">
   
      <?php
         if($user_id != ''){
      ?>
      <div class="box">
         <h3 class="title">Mes actions</h3>
         <p>Mes likes : <span><?= $total_likes; ?></span></p>
         <a href="likes.php" class="inline-btn">Mes likes</a>
         <p>Mes commentaires : <span><?= $total_comments; ?></span></p>
         <a href="comments.php" class="inline-btn">Mes commentaires</a>
         <p>Playlist enregistrer : <span><?= $total_bookmarked; ?></span></p>
         <a href="bookmark.php" class="inline-btn">Mes enregistrements</a>
      </div>
      <?php
         }else{ 
            ?>
      <img src="images/imgdegardeaccueil.png" alt="">
      <?php
      }
      ?>
   </div>



</section>





<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
   
</body>
</html>