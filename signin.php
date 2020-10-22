<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    /**http://localhost/SQL/signin.php */
    <form action="" method="POST">
        nom<input type="text" id="nom" name="nom">
        prenom<input type="text" id="prenom" name="prenom">
        email<input type="text" id="email" name="email">
        mot de passe<input type="password" id="password" name="password"><br>
        Retapez le mot de passe<input type="password" id="Npassword" name="Npassword">
        <div>
            <input type="radio" id="pro" name="profil" value="profil" checked>
            <label for="pro">professionnel</label>
        </div>

        <div>
            <input type="radio" id="particulier" name="profil" value="particulier">
            <label for="particulier">particulier</label>
        </div>
        Je reconnais avoir pris connaissance que Jotaro est le meilleur Jojo et y adhère totalement
        <input type="checkbox" id="condition" name="condition" value="condition">
        <input type="submit" id="envoyer" name="envoyer" value="envoyer">
    </form>

    <?php
   

    $erreur = "Tous les champs doivent être remplis";
    if (isset($_POST["envoyer"])) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $Npassword = $_POST['Npassword'];
        $profil = $_POST['profil'];

        $Mcondition = "merci d'accepter les conditions d'utilisation ";
        if (isset($_POST["condition"])) {
    
            $condition = $_POST['condition'];
        } else {
            echo $Mcondition;
        }

        if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['Npassword'])) {



            $maj = preg_match('@[A-Z]@', $password);
            $min = preg_match('@[a-z]@', $password);
            $nomb = preg_match('@[0-9]@', $password);
            if ($maj && $min && $nomb && strlen($password) < 8) {

                if ($_POST['password'] === $_POST['Npassword']) {
                    $bdd = new PDO('mysql:host=localhost;dbname=niveau2', 'root', '');

                    $req = $bdd->query("SELECT email FROM utilisateurs WHERE email = '$email'");
                    $count = $req->rowCount();

                    if ($count) {
                        echo "email deja existant";
                    } else {

                        $requete = "INSERT INTO utilisateurs ( nom , prenom , email , mdp , info ) VALUES (?,?,?,?,?)";
                        $co = $bdd->prepare($requete);
                        $co->execute([$nom, $prenom, $email, $password, $profil]);
                        $bdd = null;
                    }
                } else {
                    echo 'mdp correspond pas';
                }
            } else {
                echo 'mdp pas égal';
            }
        } else {
            echo 'champs vides';
        }
    }

    ?>
</body>

</html>