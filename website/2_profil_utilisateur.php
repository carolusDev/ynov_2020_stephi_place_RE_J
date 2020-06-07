<?php
session_start();

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=stephi_place_bd', 'root', '');
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
if(isset($_GET['user_id']) AND $_GET['user_id'] > 0)
{
  $getid = intval($_GET['user_id']);
  $requser = $bdd->prepare('SELECT * FROM users WHERE user_id = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();
# si le bouton "delete" est pressé, alors on lance le scripte suivant
if(isset($_POST['delete'])){
  $getid = intval($_GET['user_id']);
  $delete_element = $bdd->prepare("DELETE FROM users WHERE user_id= ?");
  $delete_element->execute(array($getid));
  header('Location: index.php');
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
  <a id="logo_entreprise_header" href="3_accueil_utilisateur.php"><img src="hc.png" alt="logo entreprise" /></a>
  <a class="bouton_menu" href="#">Contact</a>
  <a class="bouton_menu" href="3_deconnexion.php">Déconnexion</a>
  <a class="bouton_menu" href="3_edition_utilisateur.php">Edition profil</a>
</div>

<div class="main">
<table>
  <tr>
    <td>
    <h2>Profil de <?php  echo $userinfo['civilite_user']; ?> <?php echo $userinfo['name_user']; ?> <?php echo $userinfo['first_name_user']; ?></h2>
  </td>
</tr>
<tr>
  <td>
    Prénom : <?php echo $userinfo['first_name_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Nom : <?php echo $userinfo['name_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Civilité : <?php echo $userinfo['civilite_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Date de naissance : <?php echo $userinfo['dateofbirth_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Code postal : <?php echo $userinfo['code_postal_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Ville de résidence : <?php echo $userinfo['ville_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Agence : <?php echo $userinfo['agence_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Adresse résidentielle : <?php echo $userinfo['adresse_residentielle_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Numéro de téléphone : <?php echo $userinfo['numero_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Pays de résidence : <?php echo $userinfo['pays_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Email : <?php echo $userinfo['email_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Agent associé : <?php echo $userinfo['agent_user']; ?>
  </td>
</tr>
<tr>
  <td>
    Votre statut : <?php echo $userinfo['statut_user']; ?>
  </td>
</tr>
</table>
<form method="POST" action="" enctype="multipart/form-data">
<input class="bouton_submit_inscription" type="submit" name="delete" value="Supprimer mon compte"/>
</form>
    <?php
      if(isset($_SESSION['user_id']) AND $userinfo['user_id'] == $_SESSION['user_id'])
      {
        ?>
        <?php
      }
    ?>
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
<?php
}
?>
