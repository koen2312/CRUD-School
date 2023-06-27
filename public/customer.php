<?php
    require_once "../private/autoloader.php";
    $customer = CustomerManager::getcustomerID();

    try{
        if(isset($_GET["id"])){
        CustomerManager::delete($_GET["id"]);
        }
    }catch(Exception $e){
        echo "<script> alert('Je kan deze Customer niet verwijderen');</script>";
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Klanten</h1>
        <a class="btn btn-danger" href="logout.php">Uitloggen</a>
        <a class="btn btn-primary float-end" href="addcustomer.php">+ Toevoegen</a>
        <table class="table table-striped">
            <tr class="table-dark">
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Premium</th>
                <th>Land</th>
                <th>Aantal games</th>
                <th></th>
            </tr>
            <?php
            foreach($customer as $cus){
                echo "<tr>";
                echo "<td>$cus->firstname</td>";
                echo "<td>$cus->lastname</td>";
                echo "<td>$cus->email</td>";
                if($cus->premium_member == 1){
                    $p = "Ja";
                }else{
                    $p = "nee";
                }
                echo "<td>$p</td>";
                echo "<td>$cus->countryname</td>";
                echo "<td>$cus->countid</td>";
                echo "
                <td>
                <div class='dropdown'>
                    <button class='btn btn-info dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        options
                    </button>
                    <ul class='dropdown-menu'>
                        <li><a class='dropdown-item' href='updatecustomer.php?id=$cus->idcustomer'>Klant wijzigen</a></li>
                        <li><a class='dropdown-item' href='customer.php?id=$cus->idcustomer'>Klant verwijderen</a></li>
                        <li><a class='dropdown-item' href='games.php?id=$cus->idcustomer'>Mijn games</a></li>
                        <li><a class='dropdown-item' href='email.php?id=$cus->idcustomer'>E-mail versturen</a></li>
                    </ul>
                </div>
                </td>
                ";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>