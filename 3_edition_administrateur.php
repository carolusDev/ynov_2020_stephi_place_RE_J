<?php
session_start();

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=stephi_place_bd', 'root', '');
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
if(isset($_SESSION['id']))
{
  $requser = $bdd->prepare("SELECT * FROM administrateur WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  if(isset($_POST['new_prenom_administrateur']) AND !empty($_POST['new_prenom_administrateur']) AND $_POST['new_prenom_administrateur'] != $user['prenom_administrateur'])
  {
    $new_prenom_administrateur = htmlspecialchars($_POST['new_prenom_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET prenom_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_prenom_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_nom_administrateur']) AND !empty($_POST['new_nom_administrateur']) AND $_POST['new_nom_administrateur'] != $user['nom_administrateur'])
  {
    $new_nom_administrateur = htmlspecialchars($_POST['new_nom_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET nom_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_nom_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_civilite_administrateur']) AND !empty($_POST['new_civilite_administrateur']) AND $_POST['new_civilite_administrateur'] != $user['civilite_administrateur'])
  {
    $new_civilite_administrateur = htmlspecialchars($_POST['new_civilite_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET civilite_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_civilite_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_codepostal_administrateur']) AND !empty($_POST['new_codepostal_administrateur']) AND $_POST['new_codepostal_administrateur'] != $user['codepostal_administrateur'])
  {
    $new_codepostal_administrateur = htmlspecialchars($_POST['new_codepostal_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET codepostal_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_codepostal_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_ville_administrateur']) AND !empty($_POST['new_ville_administrateur']) AND $_POST['new_ville_administrateur'] != $user['ville_administrateur'])
  {
    $new_ville_administrateur = htmlspecialchars($_POST['new_ville_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET ville_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_ville_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_agence_administrateur']) AND !empty($_POST['new_agence_administrateur']) AND $_POST['new_agence_administrateur'] != $user['agence_administrateur'])
  {
    $new_agence_administrateur = htmlspecialchars($_POST['new_agence_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET agence_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_agence_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_motdepasse_administrateur']) AND !empty($_POST['new_motdepasse_administrateur']) AND $_POST['new_motdepasse_administrateur'] != $user['motdepasse_administrateur'])
  {
    $new_motdepasse_administrateur = sha1($_POST['new_motdepasse_administrateurr']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET motdepasse_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_motdepasse_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_adresse_residentielle_administrateur']) AND !empty($_POST['new_adresse_residentielle_administrateur']) AND $_POST['new_adresse_residentielle_administrateur'] != $user['adresse_residentielle_administrateur'])
  {
    $new_adresse_residentielle_administrateur = htmlspecialchars($_POST['new_adresse_residentielle_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET adresse_residentielle_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_adresse_residentielle_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_numero_administrateur']) AND !empty($_POST['new_numero_administrateur']) AND $_POST['new_numero_administrateur'] != $user['numero_administrateur'])
  {
    $new_numero_administrateur = htmlspecialchars($_POST['new_numero_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET numero_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_numero_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_pays_administrateur']) AND !empty($_POST['new_pays_administrateur']) AND $_POST['new_pays_administrateur'] != $user['pays_administrateur'])
  {
    $new_pays_administrateur = htmlspecialchars($_POST['new_pays_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET pays_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_pays_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['new_email_administrateur']) AND !empty($_POST['new_email_administrateur']) AND $_POST['new_email_administrateur'] != $user['email_administrateur'])
  {
    $new_email_administrateur = htmlspecialchars($_POST['new_email_administrateur']);
    $insert_element = $bdd->prepare("UPDATE administrateur SET email_administrateur = ? WHERE id = ?");
    $insert_element->execute(array($new_email_administrateur,$_SESSION['id']));
    header('Location: 2_profil_administrateur.php?id='.$_SESSION['id']);
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
  <a class="bouton_menu" href="#">Contact</a>
  <a class="bouton_menu" href="3_deconnexion.php">Déconnexion</a>
  <a class="bouton_menu" onclick = "history.back()">Profil</a>
</div>
<div class="main">
  <form method="POST" action="" enctype="multipart/form-data">
      <h2>Edition de mon profil</h2>
<table>
    <tr>
      <td>
        <label> Prénom : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_prenom_administrateur" placeholder="Votre prénom ..." value="<?php echo $user['prenom_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Nom : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_nom_administrateur" placeholder="Votre nom ..." value="<?php echo $user['nom_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Civilité : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_civilite_administrateur" placeholder="Votre civilité ..." value="<?php echo $user['civilite_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Code postal : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_codepostal_administrateur" placeholder="Votre code postal ..." value="<?php echo $user['codepostal_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Ville de résidence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_ville_administrateur" placeholder="Votre ville de résidence..." value="<?php echo $user['ville_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Agence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_agence_administrateur" placeholder="Votre agence ..." value="<?php echo $user['agence_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Adresse email : </label>
      </td>
      <td>
        <input size=25px type="email" name="new_email_administrateur" placeholder="Votre adresse email ..." value="<?php echo $user['email_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Confirmation adresse email : </label>
      </td>
      <td>
        <input size=25px type="email" name="new_email2_administrateur" placeholder="Votre adresse email ..." value="<?php echo $user['email_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Pays de résidence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_pays_administrateur" placeholder="Votre pays de résidence ..." value="<?php echo $user['pays_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Numéro de téléphone : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_numero_administrateur" placeholder="Votre numéro de téléphone ..." value="<?php echo $user['numero_administrateur']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Adresse résidentielle : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_adresse_residentielle_administrateur" placeholder="Votre adresse résidentielle ..." value="<?php echo $user['adresse_residentielle_administrateur']; ?>"/>
    </table>
        <input class="bouton_submit_inscription" type="submit" name="upload" value="Sauvegarder les modifications"/>
      </form>
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
<?php
}
else{
  header("location: connexion.php");
}
?>
