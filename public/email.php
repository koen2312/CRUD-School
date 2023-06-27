<?php
    require_once "../private/autoloader.php";
    require_once "../static/emailmanager.php";
    $id = CustomerManager::getid($_GET["id"]);
    $games = GameManager::emailselect($_GET["id"]);

    if($_POST){
        emailmanager::sendEmail($id->email,$_POST["subject"],$_POST["email"]);
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="email" class="col-4">
            <?php
            echo "<p>E-mail versturen naar  $id->email</p>"
            ?>
            <form method="POST">
                <div class="form-group mb-2">
                    <label for="subject">Subject</label>
                    <input class="form-control" type="tekst" name="subject"/>
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <textarea class="form-control" rows="3" type="tekst" name="email">
                        <?php foreach($games as $game){
                            echo "$game->name ";
                            } ?>
                    </textarea>
                </div>
                <button class="btn btn-primary" type="submit">Versturen</button>
                <a class="btn btn-primary float-end" href="customer.php">Terug</a>
            </form>
            
        </div>
    </body>
</html>