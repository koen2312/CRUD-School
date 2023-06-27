<?php
    //echo password_hash("admin", PASSWORD_DEFAULT);
    require_once "../static/database.php";

    $showError = false;

    if($_POST){
        $showError = true;
        $stmt = $con->prepare("SELECT * FROM user WHERE email =?");
        $stmt->bindValue(1,$_POST["email"]);
        $stmt->execute();

        $user = $stmt->fetchObject();

        if($user !== false){
            if(password_verify($_POST["password"], $user->Password_hash)){
                session_start();

                $showError = false;
                $_SESSION["userid"]= $user->iduser;
                header("location: customer.php");
            }
        }
    }
?>
<html>
    <body>
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="css/style.css">
        </head>
        
        <div class="formbox col-3">
            <img id="ictcampus" src="img/logo.png"/>
            <?php
                if($showError){
                    echo "
                    <div id='verkeerd'><p id='verkeerdtext'>
                    Kan niet in loggen met deze gegevens
                    </p> </div>";
                }
            ?>
            <form method="POST">
                <div class="form-group mb-2">
                    <label for="email">E-mailaddres</label>
                    <input class="form-control" type="text" name="email" placeholder="Voor je e-mailadres in">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Wachtwoord</label>
                    <input class="form-control" type="text" name="password" placeholder="Voor je wachtwoord in">
                </div>
                <button id="submitbutton" type="submit" class="btn btn-primary btn-lg">Inloggen</button>
            </form>
        </div>
        
    </body>
</html>