<?php
session_start();

try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=stephi_place_bd', 'root', ''); #Jonathan et moi n'avons pas utilisé le même procédé de connexion à la database, c'est pour celà que selon les pages le procédé de connexion n'est pas le même
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
if(isset($_POST['form_co'])) #si le bouton du formulaire est pressé, on lance le scripte suivant
{
  $mail_acheteur_co = htmlspecialchars($_POST['mail_acheteur_co']); # on affecte nos variables php à celles du formulaire qiu récupéres les données de l'utilisateur, on leur donne le type de varchar
  $motdepasse_acheteur_co = htmlspecialchars($_POST['motdepasse_acheteur_co']);
  if(!empty($mail_acheteur_co) AND !empty($motdepasse_acheteur_co))# on vérifie que les champs ne sont pas vides
  {
    $requser = $bdd->prepare("SELECT * FROM users WHERE email_user = ? AND password_user = ?");# requête sql permettant d'aller chercher l'utilisateur correspondant à l'email et au mot de passe de l'utilisateur
    $requser->execute(array($mail_acheteur_co, $motdepasse_acheteur_co));# on execute la requête
    $userexist = $requser->rowCount();
    if($userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['user_id'] = $userinfo['user_id']; # on affecte nos variables php aux valeurs entrées par l'utilsiateur
      $_SESSION['email_user'] = $userinfo['email_user'];
      $_SESSION['password_user'] = $userinfo['password_user'];
      header("Location: 2_profil_utilisateur.php?user_id=".$_SESSION['user_id']);#si l'authentification est faite, l'utilisateur est redirigé vers son profil
    }else{
      echo("Vérifiez votre email ou votre mot de passe !");
    }
  }else{
    echo(" Tous les champs doivent êtres complétés ! ");
  }
}
?>
<!DOCTYPE html>
<meta charset="utf-8" />  <!-- encodage du site web, langue latines -->
<html lang="fr">
<head>
<title>Stephi Place Real Estate</title>
<link rel="icon" type="image/x-icon" href="hc.png" /><!-- logo de l'entreprise affiché sur la page web -->
<link rel="stylesheet" href="index.css"> <!--lecture de la page css -->
</head>
<body>
<div class="header_menu">
  <a id="logo_entreprise_header" href="index.php"><img src="hc.png" alt="logo entreprise" /></a>
  <a class="bouton_menu" href="1_connexion_visiteur.php">Connexion</a><!--différents boutons permettants de rediriger l'utilisateur vers la page demandée -->
  <a class="bouton_menu" href="1_inscription_utilisateur.php">Inscription</a>
  <a class="bouton_menu" href="#">Contact</a><!--page de contact non faite pour des questions de temps, donc le # remplace le lien de la page contact -->
</div>

<div class="main">
<table>
  <tr>
    <td>
      <h2>Connectez vous à votre compte :</h2>
    </td>
  </tr>
    <form method="post" action="#"><!--création du formulaire traité par php -->
  <tr>
    <td>
      <label for="mail_acheteur_co">Email : </label>
    </td>
    <td>
      <input type="email" name="mail_acheteur_co" placeholder="Votre adresse email ..."/> <!--le name correspondant aux variables php-->
    </td>
  </tr>
  <tr>
    <td>
    <label for="motdepasse_acheteur_co">Mot de passe : <label/>
    </td>
    <td>
      <input type="password" name="motdepasse_acheteur_co" placeholder="Votre mot de passe ..."/>
    </td>
  </tr>
  <tr>
    <td>
      <input class="bouton_submit_inscription" type="submit" name="form_co" value="Se connecter."/> <!--bouton d'envoie du formulaire -->
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
