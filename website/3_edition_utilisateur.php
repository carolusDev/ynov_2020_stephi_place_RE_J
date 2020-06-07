<?php
session_start();
/* connexion à la base de données */
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=stephi_place_bd', 'root', '');
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
/* maintient de connexion au compte de l'utilisateur */
if(isset($_SESSION['user_id']))
{
  $requser = $bdd->prepare("SELECT * FROM users WHERE user_id = ?");
  $requser->execute(array($_SESSION['user_id']));
  $user = $requser->fetch();
/* update de chaque élément */
  if(isset($_POST['new_prenom_acheteur']) AND !empty($_POST['new_prenom_acheteur']) AND $_POST['new_prenom_acheteur'] != $user['first_name_user'])
  {
    $new_prenom_acheteur = htmlspecialchars($_POST['new_prenom_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET first_name_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_prenom_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_nom_acheteur']) AND !empty($_POST['new_nom_acheteur']) AND $_POST['new_nom_acheteur'] != $user['name_user'])
  {
    $new_nom_acheteur = htmlspecialchars($_POST['new_nom_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET name_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_nom_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_civilite_acheteur']) AND !empty($_POST['new_civilite_acheteur']) AND $_POST['new_civilite_acheteur'] != $user['civilite_user'])
  {
    $new_civilite_acheteur = htmlspecialchars($_POST['new_civilite_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET civilite_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_civilite_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_datedenaissance_acheteur']) AND !empty($_POST['new_datedenaissance_acheteur']) AND $_POST['new_datedenaissance_acheteur'] != $user['dateofbirth_user'])
  {
    $new_datedenaissance_acheteur = htmlspecialchars($_POST['new_datedenaissance_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET dateofbirth_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_datedenaissance_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_codepostale_acheteur']) AND !empty($_POST['new_codepostale_acheteur']) AND $_POST['new_codepostale_acheteur'] != $user['code_postal_user'])
  {
    $new_codepostale_acheteur = htmlspecialchars($_POST['new_codepostale_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET code_postal_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_codepostale_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_ville_acheteur']) AND !empty($_POST['new_ville_acheteur']) AND $_POST['new_ville_acheteur'] != $user['ville_user'])
  {
    $new_ville_acheteur = htmlspecialchars($_POST['new_ville_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET ville_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_ville_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_agence_acheteur']) AND !empty($_POST['new_agence_acheteur']) AND $_POST['new_agence_acheteur'] != $user['agence_user'])
  {
    $new_agence_acheteur = htmlspecialchars($_POST['new_agence_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET agence_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_agence_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_motdepasse_acheteur']) AND !empty($_POST['new_motdepasse_acheteur']) AND $_POST['new_motdepasse_acheteur'] != $user['password_user'])
  {
    $new_motdepasse_acheteur = htmlspecialchars($_POST['new_motdepasse_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET password_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_motdepasse_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_adresse_residentielle_acheteur']) AND !empty($_POST['new_adresse_residentielle_acheteur']) AND $_POST['new_adresse_residentielle_acheteur'] != $user['adresse_residentielle_user'])
  {
    $new_adresse_residentielle_acheteur = htmlspecialchars($_POST['new_adresse_residentielle_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET adresse_residentielle_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_adresse_residentielle_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_numero_acheteur']) AND !empty($_POST['new_numero_acheteur']) AND $_POST['new_numero_acheteur'] != $user['numero_user'])
  {
    $new_numero_acheteur = htmlspecialchars($_POST['new_numero_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET numero_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_numero_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_statut_acheteur']) AND !empty($_POST['new_statut_acheteur']) AND $_POST['new_statut_acheteur'] != $user['statut_user'])
  {
    $new_statut_acheteur = htmlspecialchars($_POST['new_statut_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET statut_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_statut_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_pays_acheteur']) AND !empty($_POST['new_pays_acheteur']) AND $_POST['new_pays_acheteur'] != $user['pays_user'])
  {
    $new_pays_acheteur = htmlspecialchars($_POST['new_pays_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET pays_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_pays_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
  }
  if(isset($_POST['new_mail_acheteur']) AND !empty($_POST['new_mail_acheteur']) AND $_POST['new_mail_acheteur'] != $user['email_user'])
  {
    $new_mail_acheteur = htmlspecialchars($_POST['new_mail_acheteur']);
    $insert_element = $bdd->prepare("UPDATE users SET email_user = ? WHERE user_id = ?");
    $insert_element->execute(array($new_mail_acheteur,$_SESSION['user_id']));
    header('Location: 2_profil_utilisateur.php?user_id='.$_SESSION['user_id']);
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
        <input size=25px type="text" name="new_prenom_acheteur" placeholder="Votre prénom ..." value="<?php echo $user['first_name_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Nom : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_nom_acheteur" placeholder="Votre nom ..." value="<?php echo $user['name_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Civilité : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_civilite_acheteur" placeholder="Votre civilité ..." value="<?php echo $user['civilite_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Date de naissance : </label>
      </td>
      <td>
        <input size=25px type="date" name="new_datedenaissance_acheteur" value="<?php echo $user['dateofbirth_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Code postal : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_codepostale_acheteur" placeholder="Votre code postal ..." value="<?php echo $user['code_postal_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Ville de résidence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_ville_acheteur" placeholder="Votre ville de résidence..." value="<?php echo $user['ville_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Agence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_agence_acheteur" placeholder="Votre agence ..." value="<?php echo $user['agence_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Mot de passe : </label>
      </td>
      <td>
        <input size=25px type="password" name="new_motdepasse_acheteur" placeholder="Votre mot de passe ..."/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Confirmation de mot de passe : </label>
      </td>
      <td>
        <input size=25px type="password" name="new_motdepasse2_acheteur" placeholder="Votre mot de passe ..."/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Adresse email : </label>
      </td>
      <td>
        <input size=25px type="email" name="new_mail_acheteur" placeholder="Votre adresse email ..." value="<?php echo $user['email_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Confirmation adresse email : </label>
      </td>
      <td>
        <input size=25px type="email" name="new_mail2_acheteur" placeholder="Votre adresse email ..." value="<?php echo $user['email_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Pays de résidence : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_pays_acheteur" placeholder="Votre pays de résidence ..." value="<?php echo $user['pays_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Numéro de téléphone : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_numero_acheteur" placeholder="Votre numéro de téléphone ..." value="<?php echo $user['numero_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Votre statut : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_statut_acheteur" placeholder="Vendeur ou Acheteur ?" value="<?php echo $user['statut_user']; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        <label> Adresse résidentielle : </label>
      </td>
      <td>
        <input size=25px type="text" name="new_adresse_residentielle_acheteur" placeholder="Votre adresse résidentielle ..." value="<?php echo $user['adresse_residentielle_user']; ?>"/>
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
  header("location: 2_profil_utilisateur.php");
}
?>
