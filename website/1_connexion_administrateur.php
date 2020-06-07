<?php
session_start();

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=stephi_place_bd', 'root', '');
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
if(isset($_POST['form_co']))
{
  $email_administrateur_co = htmlspecialchars($_POST['email_administrateur_co']);
  $code_administrateur_co = htmlspecialchars($_POST['code_administrateur_co']);
  if(!empty($email_administrateur_co) AND !empty($code_administrateur_co))
  {
    $requser = $bdd->prepare("SELECT * FROM administrateur WHERE email_administrateur = ? AND code_administrateur = ?");
    $requser->execute(array($email_administrateur_co, $code_administrateur_co));
    $userexist = $requser->rowCount();
    if($userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['email_administrateur'] = $userinfo['email_administrateur'];
      $_SESSION['code_administrateur'] = $userinfo['code_administrateur'];
      header("Location: 2_profil_administrateur.php?id=".$_SESSION['id']);
    }else{
      echo("Vérifiez votre email ou votre code personnel !");
    }
  }else{
    echo(" Tous les champs doivent êtres complétés ! ");
  }
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
  <a class="bouton_menu" href="1_connexion_visiteur.php">Connexion</a>
  <a class="bouton_menu" href="1_inscription_utilisateur.php">Inscription</a>
  <a class="bouton_menu" href="#">Contact</a>
</div>

<div class="main">
<table>
  <tr>
    <td>
      <h2>Connectez vous à votre compte :</h2>
    </td>
  </tr>
    <form method="post" action="#">
  <tr>
    <td>
      <label for="email_administrateur_co">Email : </label>
    </td>
    <td>
      <input type="email" name="email_administrateur_co" placeholder="Votre adresse email ..."/>
    </td>
  </tr>
  <tr>
    <td>
    <label for="code_administrateur_co">Code : <label/>
    </td>
    <td>
      <input maxlength="20" type="password" name="code_administrateur_co" placeholder="Votre code personnel ..."/>
    </td>
  </tr>
  <tr>
    <td>
      <input class="bouton_submit_inscription" type="submit" name="form_co" value="Se connecter."/>
    </td>
  </tr>
</table>
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
