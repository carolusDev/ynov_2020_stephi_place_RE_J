<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="fr">
<head>
<title>Stephi Place Real Estate</title>
<link rel="icon" type="image/x-icon" href="hc.png" />
<link rel="stylesheet" href="index.css">
</head>
<?php
session_start();
$parameters = parse_ini_file ('./db.ini');
try {
  $dbh = new PDO($parameters['url'], $parameters['user'], $parameters['password']);
} catch (\Exception $e) {
  die("erreur :" .$e->getMessage());
}
if(isset($_POST['formsend'])){
  echo "ok formsend";
  if(!empty($_POST['name_user']) && !empty($_POST['password_0']) && !empty($_POST['password_1']) && !empty($_POST['email_user_0']) && !empty($_POST['email_user_1']) && !empty($_POST['dateofbirth_user']) && !empty($_POST['first_name_user'])
  && !empty($_POST['numero_user']) && !empty($_POST['civilite_user']) && !empty($_POST['agent_user']) && !empty($_POST['agence_user']) && !empty($_POST['adresse_residentielle_user']) && !empty($_POST['code_postal_user']) && !empty($_POST['ville_user'])
  && !empty($_POST['pays_user']) && !empty($_POST['statut_user'])){
    echo "ok check password";
    if($_POST['email_user_0'] == $_POST['email_user_1']){
      if($_POST['password_0'] == $_POST['password_1']){
        echo "test";
        $password = sha1($_POST['password_0']);
        $insert = $dbh->prepare('INSERT INTO users (password_user, name_user, email_user, dateofbirth_user, first_name_user, numero_user, civilite_user, agent_user, agence_user, adresse_residentielle_user, code_postal_user, ville_user, pays_user, statut_user)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $insert->execute(array($_POST['name_user'], $_POST['password_0'], $_POST['email_user_0'], $_POST['dateofbirth_user'], $_POST['first_name_user'], $_POST['numero_user'], $_POST['civilite_user'], $_POST['agent_user'], $_POST['agence_user'],
        $_POST['adresse_residentielle_user'], $_POST['code_postal_user'], $_POST['ville_user'], $_POST['pays_user'], $_POST['statut_user']));
        echo $insert->rowCount();
        if($insert->rowCount() == 1){
        }
      }else{
        echo "Les mots de passes ne correspondent pas !";
      }
    }else{
      echo "Il faut que tous les champs soient complétés !";
    }
    }
  }
?>
<body>
  <div class="header_menu">
    <a id="logo_entreprise_header" href="index.php"><img src="hc.png" alt="logo entreprise" /></a>
    <a class="bouton_menu" href="1_connexion_visiteur.php">Connexion</a>
    <a class="bouton_menu" href="1_contact_visiteur.php">Contact</a>
  </div>
  <div class="main">
  <div class="formulaire_acheteur">
    <form method = "POST" action = "#">
        <table>
          <tr>
            <td>
              <label for="name_user">Nom : </label>
              </td>
              <td>
              <input type = "text" name = "name_user" id = "name_user" placeholder = "Votre nom ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="first_name_user_label">Prénom : </label>
              </td>
              <td>
              <input type = "text" name = "first_name_user" id = "first_name_user" placeholder = "Votre Prénom ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="civilite_user_lab"> Votre civilite : </label>
              </td>
              <td>
              <input type = "text" name = "civilite_user" id = "civilite_user" placeholder = "Monsieur, Madame ou Autre ?" required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="numero_user_lab"> Numéro de téléphone : </label>
              </td>
              <td>
              <input type = "text" name = "numero_user" id = "numero_user" placeholder = "Votre numéro de téléphone ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="password_0_lab">Mot de passe : </label>
              </td>
              <td>
              <input type = "password" name = "password_0" id = "password_0" placeholder = "Votre mot de passe ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="password_1_lab">Confirmation mot de passe : </label>
              </td>
              <td>
              <input type = "password" name = "password_1" id = "password_1" placeholder = "Confirmation de votre mot de passe ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="email_user_confirmation_lab">Adresse email : </label>
              </td>
              <td>
              <input type = "email" name = "email_user_1" id = "email_user_1" placeholder = "Votre adresse email ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="email_user_confirmation"> Confirmation email : </label>
              </td>
              <td>
              <input type = "email" name = "email_user_0" id = "email_user_0" placeholder = "Confirmation de votre adresse email ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="date_de_naissance_lab"> Date de naissance : </label>
              </td>
              <td>
              <input type = "date" name = "dateofbirth_user" id = "dateofbirth_user" required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="agent_lab">Agent : </label>
              </td>
              <td>
              <input type = "text" name = "agent_user" id = "agent_user" placeholder = "Si vous avez un agent, sinon laissez vide."/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="agence_lab">Agence : </label>
              </td>
              <td>
              <input type = "text" name = "agence_user" id = "agence_user" placeholder = "Entrez une de nos agences proche de vous."/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="adresse_lab">Adresse résidentielle : </label>
              </td>
              <td>
              <input type = "text" name = "adresse_residentielle_user" id = "adresse_residentielle_user" placeholder = "Votre adresse résidentielle ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="copost_lab">Code postal : </label>
              </td>
              <td>
              <input type = "text" name = "code_postal_user" id = "code_postal_user" placeholder = "Votre code postal ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="ville_lab">Ville : </label>
              </td>
              <td>
              <input type = "text" name = "ville_user" id = "ville_user" placeholder = "Votre ville ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="pays_lab">Pays : </label>
              </td>
              <td>
              <input type = "text" name = "pays_user" id = "pays_user" placeholder = "Votre nationalité ..." required/>
            </td>
          </tr>
          <tr>
            <td>
              <label for="stat_lab">Stat : </label>
              </td>
              <td>
              <input type = "text" name = "statut_user" id = "statut_user" placeholder = "Vous êtes vendeur ou acheteur ?" required/>
            </td>
          </tr>
        </table>
      <input type = "submit" name = "formsend" id = "formsend" value = "ok"/>
    </form>
  </div>
  <div class="informations_villes_agences">
  <div class="villes_1">
    <ul>
      <li>Aix</li>
      <li>Paris</li>
      <li>Marseille</li>
      <li>Tours</li>
      <li>Brest</li>
      <li>Mans</li>
      <li>Clermont-Ferrand</li>
      <li>Villeurbanne</li>
      <li>Nimes</li>
      <li>Angers</li>
      <li>Dijon</li>
      <li>Grenoble</li>
      <li>Toulon</li>
      <li>Havre</li>
      <li>Saint-Etienne</li>
      <li>Reims</li>
      <li>Rennes</li>
      <li>Lille</li>
      <li>Bordeaux</li>
      <li>Montpellier</li>
      <li>Strasbourg</li>
      <li>Nantes</li>
      <li>Nice</li>
      <li>Toulouse</li>
      <li>Lyon</li>
    </ul>
  </div>
  <div class="villes_2">
    <ul>
      <li>Amiens</li>
      <li>Limoges</li>
      <li>Annecy</li>
      <li>Perpignan</li>
      <li>Boulogne-Billancourt</li>
      <li>Metz</li>
      <li>Besançon</li>
      <li>Orléans</li>
      <li>Colombes</li>
      <li>Argenteuil</li>
      <li>Rouen</li>
      <li>Mulhouse</li>
      <li>Montreuil</li>
      <li>Saint-Paul</li>
      <li>Caen</li>
      <li>Nancy</li>
      <li>Tourcoing</li>
      <li>Roubaix</li>
      <li>Nanterre</li>
      <li>Vitry-sur-Seine</li>
      <li>Avignon</li>
      <li>Créteil</li>
      <li>Dunkerque</li>
      <li>Poitiers</li>
      <li>Aubervilliers</li>
    </ul>
  </div>
</div>
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
