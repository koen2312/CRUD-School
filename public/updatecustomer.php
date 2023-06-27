<?php
    require_once "../private/autoloader.php";
    $country = CustomerManager::country();
    $id = CustomerManager::getid($_GET["id"]);

    if($_POST){
        CustomerManager::update($_GET["id"],$_POST);
    }

    
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="containter">
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-4">
                    <h1>Klant Wijzigen</h1>
                    <form method="POST">
                        <div class="form-group mb-2">
                            <label for="firstname">Voornaam</label>
                            <input class="form-control" id="firstname" type="tekst" name="firstname" value="<?php echo $id->firstname ?>">
                        </div>
                        <div class="form-group mb-2">
                            <label for="lastname">Achternaam</label>
                            <input class="form-control" id="lastname" type="tekst" name="lastname" value="<?php echo $id->lastname ?>">
                        </div>
                        <div class="forum-group mb-2">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="tekst" name="email" value="<?php echo $id->email ?>">
                        </div>
                        <div class="form-check mb-2">
                                <?php
                                    $checked = ($id->premium_member == 1) ? " checked " : "";
                                    echo "<input class='form-check-input' name='premium' type='checkbox' $checked value='xxx'>";
                                ?>
                                
                            <label for="premium">Premium Klant</label>
                        </div>
                        <div class="form-group mb-2">
                            <select name="country">
                                <?php
                                    foreach($country as $cu){
                                        if($id->country_idcountry == $cu->idcountry){
                                            echo "<option selected value='$cu->idcountry'>$cu->name</opdtion>";
                                        }else{
                                            echo"<option value='$cu->idcountry'>$cu->name</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <br/>
                        <button class="btn btn-primary" type="submit">Opslaan</button>
                    </form>
                </div>
                <div class="col-1">

                </div>

            </div>
        </div>
        
    </body>
</html>