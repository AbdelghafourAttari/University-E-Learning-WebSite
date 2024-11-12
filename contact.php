<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number']; 
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg']; 
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'message vien d etre envoyer';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'message bien envoyer';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="contact">

   <div class="row">

      

      <form action="" method="post">
         <h3>Ecrire votre message</h3>
         <input type="text" placeholder="enter votre nom complet" required maxlength="100" name="name" class="box">
         <input type="email" placeholder="enter votre email" required maxlength="100" name="email" class="box">
         <input type="number" min="0" max="9999999999" placeholder="enter votre numero de telephone" required maxlength="10" name="number" class="box">
         <textarea name="msg" class="box" placeholder="enter votre message" required cols="30" rows="10" maxlength="1000"></textarea>
         <input type="submit" value="Envoyer" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Numero de telephone</h3>
         <a href="tel:1234567890">0522343482</a>
      </div>

      <div class="box">
         <i class="fas fa-envolope"></i>
         <h3>Adresse E-mail</h3>
         <a href="mailto:shaikhanas@gmail.com">fsjes@gmail.come</a>
         
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Localisation</h3>
         <a href="#">2634، Route des Chaux et Ciments Beausite, Casablanca 20254</a>
      </div>


   </div>

</section>


<?php include 'components/footer.php'; ?>  

<script src="js/script.js"></script>
   
</body>
</html>