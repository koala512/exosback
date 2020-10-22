<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        login<input type="text" id="login" name="login">
        password<input type="password" id="password" name="password">
        <input type="submit" id="envoyer" name="envoyer" value="envoyer">
    </form>

    <?php 
   
    $erreur = "Tous les champs doivent être remplis";
    if (isset($_POST["envoyer"])) {

        if (!empty($_POST['login']) and !empty($_POST['password'])) {

            $bdd = new PDO('mysql:host=localhost;dbname=niveau2', 'root', '');

            $login = $_POST['login'];
            $password = $_POST['password'];
            $date = date('Y-m-d H:i:s');

            $requete = "INSERT INTO connexion ( login , password , date ) VALUES ('$login','$password','$date')";
            $co = $bdd->prepare($requete);
            $co->execute(); 
            $bdd = null;
        } else {
            echo $erreur;
        }
    }
    ?>


</body>

</html>