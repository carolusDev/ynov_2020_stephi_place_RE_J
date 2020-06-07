<?php
session_start();
$parameters = parse_ini_file ('./db.ini');

try {
  $dbh = new PDO($parameters['url'], $parameters['user'], $parameters['password']);
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
?>
<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="fr">
<head>
<title>Stephi Place Real Estate</title>
<link rel="icon" type="image/x-icon" href="hc.png" />
<link rel="stylesheet" href="index.css">
</head>
<body>
<div class="header_menu">
    <a id="logo_entreprise_header" href="index.php"><img src="hc.png" alt="logo entreprise" /></a>
    <a class="bouton_menu" href="2_profil_utilisateur.php">Profil</a>
    <a class="bouton_menu" href="#">Contact</a>
</div>

<div class="main">
  <form action="#" method="POST">
    <label>superficie</label>
    <input type="text" id="superficie" name="superficie" placeholder="entrez la superficie minimale voulue">
    <label>prix max</label>
    <input type="text" id="prixmx" name="prixmx" placeholder="entrez le prix maximal voulu">
    <label>agence</label>
    <input type="text" id="agence" name="agence" placeholder="entrez la ville de l'agence que vous désirez">
    <input type="submit" value="valider">
  </form>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <?php

    #on trie selon les critères demandés
  if(!empty($_POST['superficie'])){
    $superficie=$_POST['superficie'];

    if(!empty($_POST['prixmx'])){
      $prix=$_POST['prixmx'];

      if(!empty($_POST['agence'])){
        $agence=$_POST['agence'];
        $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie AND prix_annonce < $prix AND ville_annonce = '$agence'");
        while ($donnees=$reqAnnonces->fetch()){
          $jardin = $donnees['jardin_annonce'];
          ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
        <?php
        }#tout le reste suit le même principe selon ce que l'utilisateur a rentré
      }else{
        $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie AND prix_annonce < $prix ");
        while ($donnees=$reqAnnonces->fetch()){
          $jardin = $donnees['jardin_annonce'];
          ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
        <?php
      }
    }

    }
    if(!empty($_POST['agence'])){
      $agence=$_POST['agence'];
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie AND ville_annonce = '$agence'");
      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
      }
      }else{
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie ");
      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
      }
    }

  }elseif(!empty($_POST['prixmx'])){
    $prix=$_POST['prixmx'];

    if(!empty($_POST['superficie'])){
      $superficie=$_POST['superficie'];

      if(!empty($_POST['agence'])){
        $agence=$_POST['agence'];
        $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie AND prix_annonce < $prix AND ville_annonce = '$agence'");
        while ($donnees=$reqAnnonces->fetch()){
          $jardin = $donnees['jardin_annonce'];
          ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
        <?php
        }

      }else{
        $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND superficie_annonce > $superficie AND prix_annonce < $prix ");
        while ($donnees=$reqAnnonces->fetch()){
          $jardin = $donnees['jardin_annonce'];
          ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
        <?php
      }
    }
  }
  if(!empty($_POST['agence'])){
      $agence=$_POST['agence'];
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND prix_annonce < $prix AND ville_annonce = '$agence'");
      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
      }
    }
    else{
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND prix_annonce < $prix ");
      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
      }
    }

  }elseif(!empty($_POST['agence'])){
    $agence=$_POST['agence'];
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE statut_annonces != 'vendu' AND ville_annonce = '$agence' ");
      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
      }

  }else {
      $reqAnnonces=$dbh->query("SELECT * FROM annonces where statut_annonces != 'vendu' ");

      while ($donnees=$reqAnnonces->fetch()){
        $jardin = $donnees['jardin_annonce'];
        ?>
        <div>
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> type : <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
          <p> <?php echo $donnees['description_annonce'] ?> </p>
          <p>nombre de pièces : <?php echo $donnees['nombredepieces_annonce'] ?> | superficie : <?php echo $donnees['superficie_annonce'] ?> m² </p>
          <p> ville : <?php echo $donnees['codepostale_annonce'] ?>, <?php echo $donnees['ville_annonce'] ?> | <?php echo $donnees['lieu_annonce'] ?> </p>
          <p>jardin : <?php echo $jardin ?> | piscine :  <?php echo $donnees['piscine_annonce']?> <?php if($jardin=='oui'){ ?> | superficie du jardin : <?php echo $donnees['superficiejardin_annonce']; ?>  m² <?php } ?></p>
          <p>présence d'un parking privé ? : <?php echo $donnees['parkingprive_annonce']?></p>
          <p>prix : <?php echo $donnees['prix_annonce'] ?>€</p>
          <br>
          <hr>
        </div>
      <?php
    }
  }

#on revient au début de la base de données pour tout réafficher par la suite
  $reqAnnonces->closeCursor();
  ?>


</div>

  <div class="footer">
      <div class="text_footer">
          <div id="footer_p_left_div">
              <p id="footer_p_left">Stephi Place Real Estate</p>
          </div>
          <div id="footer_p_right_div">
              <p id="footer_p_center">Copyright 2020</p>
          </div>
      </div>
      <div class="social_network_footer">
          <a href="https://www.facebook.com/clementpascal.charlemagne"><img id="facebook_img" src="facebook.png" alt="image facebook" /></a>
          <a href="https://twitter.com/charlem64754799"><img id="twitter_img" src="twitter.png" alt="image twitter" /></a>
          <a href="https://www.instagram.com/"><img id="instagram_img" src="instagram.png" alt="image instagram" /></a>
          <a href="https://www.linkedin.com/in/cl%C3%A9ment-charlemagne-91363a180/"><img id="linkedin_img" src="linkedin.png" alt="image linkedin" /></a>
      </div>
  </div>
</body>
</html>
