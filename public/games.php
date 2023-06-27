<?php
    require_once "../private/autoloader.php";

    $games = GameManager::getall();
    if($_GET["id"]){
        $select = GameManager::getselect($_GET["id"]);
        $customer = CustomerManager::getid($_GET["id"]);
    }
    if($_POST){
        GameManager::insert($_POST,$_GET["id"]);
    }
    try{
        if(isset($_GET["gameid"])){
        GameManager::delete($_GET["gameid"]);
        }
    }catch(Exception $e){
        echo "<script> alert('Je kan deze Game niet verwijderen');</script>";
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <form method="POST">
            <?php 
            echo "<h1>$customer->firstname</h1>";
            ?>
            <div class="form-group mb-2">
                <select name="game">
                    <?php
                        foreach($games as $game){
                            echo"<option value='$game->idgame'>$game->name</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Game Toevoegen</button>
            <a class="btn btn-primary float-end" href="customer.php">Terug</a>
        </form>
        
        <table class="table table-striped">
            <tr class="table-dark">
                <th>Naam</th>
                <th>Platform</th>
                <th></th>
            </tr>
            <?php
                foreach($select as $selec){
                    echo "<tr>";
                    echo "<td>$selec->name</td>";
                    echo "<td>$selec->nameplatform<td>";
                    echo "<a class='btn btn-danger' href='games.php?gameid=$selec->idcustomer_game'>X</a>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>