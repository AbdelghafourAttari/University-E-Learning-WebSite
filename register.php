<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'Email déja utiliser';
   }else{
      if($pass != $cpass){
         $message[] = 'Mot de passe incorrecte';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Accueil</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Creer votre compte</h3>
      <div class="flex">
         <div class="col">
            <p>Nom Complet <span>*</span></p>
            <input type="text" name="name" placeholder="enter votre nom" maxlength="50" required class="box">
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter votre email" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>Mot de passe <span>*</span></p>
            <input type="password" name="pass" placeholder="enter votre mot de passe" maxlength="20" required class="box">
            <p>confirmer votre Mot de passe <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirmer votre mot de passe" maxlength="20" required class="box">
         </div>
      </div>
      <p>Choisir une image <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">Avez-vous déjà un compte? <a href="login.php">Se connecter</a></p>
      <input type="submit" name="submit" value="S'inscrire" class="btn">
   </form>

</section>

<?php include 'components/footer.php'; ?>


<script src="js/script.js"></script>
   
</body>
</html>