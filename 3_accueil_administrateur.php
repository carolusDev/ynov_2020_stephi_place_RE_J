<?php
session_start();
#on se connecte à la base de données via un fichier .ini
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
    <a id="logo_entreprise_header" href="3_accueil_administrateur.php"><img src="hc.png" alt="logo entreprise" /></a>
    <a class="bouton_menu" href="3_deconnexion.php">Déconnexion</a>
    <a class="bouton_menu" href="2_profil_administrateur.php">Profil</a>
    <a class="bouton_menu" href="#">Contact</a>
</div>
<!-- ici on met le formulaire pour trier les annonces -->
<div class="main">
  <form action="3_accueil_administrateur.php" method="POST">
    <label>superficie</label>
    <input type="text" id="superficie" name="superficie" placeholder="entrez la superficie minimale voulue">
    <label>prix max</label>
    <input type="text" id="prixmx" name="prixmx" placeholder="entrez le prix maximal voulu">
    <label>agence</label>
    <input type="text" id="agence" name="agence" placeholder="entrez la ville de l'agence que vous désirez">
    <label>sélectionner une annonce</label>
    <input type="text" id="select" name="select" placeholder="entrez l'annonce spécifique à modifier">
    <input type="submit" value="valider">
  </form>
  <?php
  #on gère la suppresion de l'annonce selectionnée
  if(isset($_POST['supprimer'])){
    $id = $_POST['id'];
    $pdoQuery = "DELETE FROM annonces WHERE id = $id";
    $pdoResult = $dbh->exec($pdoQuery);
    header("Location: 3_accueil_administrateur.php");
  }
  #on prépare la modification de l'annonce sélectionnée
  if(isset($_POST['confirmer'])) {
    $titre=$_POST['titre'];
    $id=$_POST['id'];
    $identifiant=$_POST['identifiant'];
    $type=$_POST['type'];
    $statut=$_POST['statut'];
    $descr=$_POST['descr'];
    $pieces=$_POST['pieces'];
    $superficie=$_POST['superficie'];
    $jardin=$_POST['jardin'];
    $piscine=$_POST['piscine'];
    $superf_jardin=$_POST['superf_jardin'];
    $parking=$_POST['parking'];
    $prix=$_POST['prix'];
    $ville=$_POST['ville'];
    $cde_postal=$_POST['cde_postal'];
    $frais=$_POST['frais'];
    $visavis=$_POST['visavis'];
    $lieu=$_POST['lieu'];
    $agent=$_POST['agent'];
    #on modifie dans la base de données
    $pdoUpdate = $dbh->prepare("UPDATE `annonces` SET `titre_annonce`=?, `identifiant_annonce`=?, `type_annonce`=?, `statut_annonces`=?,`description_annonce`=?,
    `nombredepieces_annonce`=?, `superficie_annonce`=?, `jardin_annonce`=?,`piscine_annonce`=?, `superficiejardin_annonce`=?, `parkingprive_annonce`=?, `prix_annonce`=?,
    `ville_annonce`=?, `codepostale_annonce`=?, `fraisagence_annonce`=?, `visavis_annonce`=?,
    `lieu_annonce`=?, `agent_annonce`=? where id=?");
    $pdoUpdate->execute(array($titre,$identifiant,$type,$statut,$descr,$pieces,$superficie,$jardin,$piscine,$superf_jardin,$parking,$prix,$ville,$cde_postal,$frais,$visavis,$lieu,$agent,$id));
    header("Location: 3_accueil_administrateur.php");
  }
  #on sélectionne les annonces si l'administrateur a rempli le champ correspondant
  if(!empty($_POST['select'])){
      $select=$_POST['select'];
      $reqAnnonces=$dbh->query("SELECT * FROM annonces WHERE identifiant_annonce = '$select'");
      $donnees=$reqAnnonces->fetch();
      $db_titre=$donnees['titre_annonce'];
      $db_id=$donnees['id'];
      $db_identifiant=$donnees['identifiant_annonce'];
      $db_type=$donnees['type_annonce'];
      $db_statut=$donnees['statut_annonces'];
      $db_descr=$donnees['description_annonce'];
      $db_pieces=$donnees['nombredepieces_annonce'];
      $db_superficie=$donnees['superficie_annonce'];
      $db_jardin = $donnees['jardin_annonce'];
      $db_piscine=$donnees['piscine_annonce'];
      $db_superf_jardin=$donnees['superficiejardin_annonce'];
      $db_parking=$donnees['parkingprive_annonce'];
      $db_prix=$donnees['prix_annonce'];
      $db_ville=$donnees['ville_annonce'];
      $db_cde_postal=$donnees['codepostale_annonce'];
      $db_frais=$donnees['fraisagence_annonce'];
      $db_visavis=$donnees['visavis_annonce'];
      $db_lieu=$donnees['lieu_annonce'];
      $db_agent=$donnees['agent_annonce'];


        ?>
        <!-- on affiche l'annonce sélectionnée dans un formulaire afin de pouvoir la modifier à souhait -->
        <div>
        <form action="3_accueil_administrateur.php" method="POST">
        <label>titre : </label>
        <input type="text" name="titre" value="<?php echo($db_titre)?>"> <br>
        <label>identifiant</label>
        <input type="text" name="id" value="<?php echo($db_id) ?>"> <br>
        <label>nom : </label>
        <input type="text" name="identifiant" value="<?php echo($db_identifiant)?>"> <br>
        <label>type d'annonce : </label>
        <input type="text" name="type" value="<?php echo($db_type)?>"> <br>
        <label>statut de l'annonce : </label>
        <input type="text" name="statut" value="<?php echo($db_statut)?>"> <br>
        <label>ville</label>
        <input type="text" name="ville" value="<?php echo($db_ville)?>"> <br>
        <label>code postal</label>
        <input type="text" name="cde_postal" value="<?php echo($db_cde_postal) ?>"> <br>
        <label>lieu</label>
        <input type="text" name="lieu" value="<?php echo($db_lieu) ?>"> <br>
        <label>description de l'annonce : </label>
        <input type="textbox" name="descr"  value="<?php echo($db_descr)?>"> <br>
        <label>nombre de pièces : </label>
        <input type="text" name="pieces" value="<?php echo($db_titre)?>"><br>
        <label>superficie du bien : </label>
        <input type="text" name="superficie" value="<?php echo($db_superficie)?>"><br>
        <label>présence d'un jardin : </label>
        <input type="text" name="jardin" value="<?php echo($db_jardin)?>"><br>
        <label>présence d'une piscine : </label>
        <input type="text" name="piscine" value="<?php echo($db_piscine)?>"><br>
        <label>superficie du jardin : </label>
        <input type="text" name="superf_jardin" value="<?php echo($db_superf_jardin)?>"><br>
        <label>présence d'un parking : </label>
        <input type="text" name="parking" value="<?php echo($db_parking)?>"><br>
        <label>présence de vis à vis</label>
        <input type="text" name="visavis" value="<?php echo($db_visavis) ?>"><br>
        <label>prix du bien : </label>
        <input type="text" name="prix" value="<?php echo($db_prix)?>"><br>
        <label>frais d'agence</label>
        <input type="text" name="frais" value="<?php echo($db_frais) ?>"><br>
        <label>agent</label>
        <input type="text" name="agent" value="<?php echo($db_agent) ?>"><br>
        <input type="submit" value="confirmer" name="confirmer">
        <input type="submit" value="supprimer" name="supprimer">
        <input type="reset" value="reset">
        </form>
        </div>
<?php
#si l'utilisateur n'a rien sélectionné, on affiche les annonces
  }else{
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
          <!-- on affiche les annonces correspondantes aux critères -->
            <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
            <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
            <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2>  <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p> <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
            <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2>  <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p> <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2>  <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p> <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p>  <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
          <p> <h2><?php echo $donnees['titre_annonce'] ?>  </h2> <p> identifiant :  <?php echo $donnees['identifiant_annonce'] ?> </p> <?php echo $donnees['type_annonce']?> | statut : <?php echo $donnees['statut_annonces'] ?></p>
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
