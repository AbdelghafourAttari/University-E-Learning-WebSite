<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

   <img src="images/logofaculte.png" class="logo"><h1>FSJES Ain Sebaa</h1>

      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="Effectuer une recherche" required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
        
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="profile.php" class="btn">Mon compte</a>
         <div class="flex-btn">
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('Vous-voulez se deconnecter?');" class="delete-btn">Deconnecter</a>
         <?php
            }else{
         ?>
         <h3>Connecter-vous</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">Se connecter</a>
            <a href="register.php" class="option-btn">S'inscire</a>
         </div>
         <?php
            }
         ?>
      </div>

   </section>

</header>


<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="profile.php" class="btn">Mon compte</a>
         <?php
            }else{
         ?>
         <h3>Connecter-vous</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">Etudiant</a>
            <a href="admin/login.php" class="option-btn">Enseignant</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i><span>Accueil</span></a>
      <a href="playlists.php"><i class="fa-solid fa-bars-staggered"></i><span>playlists</span></a>
      <a href="contents.php"><i class="fas fa-graduation-cap"></i><span>contenu</span></a>
      <a href="comments.php"><i class="fas fa-comment"></i><span>commentaire</span></a>
      <a href="../components/admin_logout.php" onclick="return confirm('Voulez-vous se deconnecter?');"><i class="fas fa-right-from-bracket"></i><span>Deconnecter</span></a>
   </nav>

</div>

