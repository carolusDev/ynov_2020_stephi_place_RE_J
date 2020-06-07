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
          echo "yeeees ";
        }
      }else{
        echo "Les mots de passes ne correspondent pas !";
      }
    }else{
      echo "Il faut que tous les champs soient complétés !";
    }
    echo "fin check password";
    }
    echo "formsend";
  }
?>
