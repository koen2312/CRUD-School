<?php
    require_once "../static/database.php";

    class CustomerManager{
        public static function getall(){
            global $con;
            $stmt = $con->prepare("SELECT * FROM customer");
            $stmt->execute();

            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
        public static function getid($id){
            global $con;
            $stmt = $con->prepare("SELECT * FROM ratjetoe.customer where idcustomer = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return $stmt-> fetchObject();
        }
        public static function delete($id){
            global $con;
            $stmt = $con->prepare("DELETE FROM customer_game WHERE customer_idcustomer=?");
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $stmt = $con->prepare("DELETE FROM customer where idcustomer=?");
            $stmt->bindValue(1,$id);
            $stmt->execute();
            header("location: customer.php");
        }
        public static function country(){
            global $con;
            $stmt = $con->prepare("SELECT * FROM country");
            $stmt->execute();

            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
        public static function getcustomerID(){
            global $con;
            $stmt = $con->prepare("SELECT customer.idcustomer,
            customer.firstname, 
            customer.lastname, 
            customer.email, 
            customer.premium_member, 
            country.`name`as countryname,
            (SELECT COUNT(*) FROM customer_game WHERE customer_game.customer_idcustomer = customer.idcustomer) AS countid
                FROM 
            ratjetoe.customer
            JOIN country ON country.idcountry = customer.country_idcountry;");
            $stmt->execute();

            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
        public static function insert($customer){
            global $con;
            $stmt = $con->prepare("INSERT INTO `ratjetoe`.`customer` (`firstname`, `lastname`, `email`, `premium_member`, `country_idcountry`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $customer["firstname"] );
            $stmt->bindValue(2, $customer["lastname"]);
            $stmt->bindValue(3, $customer["email"]);
            $stmt->bindValue(4, $customer["premium"]);
            $stmt->bindValue(5, $customer["country"]);
            $stmt->execute();

            header('Location: customer.php');
        }
        public static function update($id,$customer){
            global $con;
            $stmt = $con->prepare("UPDATE `ratjetoe`.`customer` SET `firstname` = ?, `lastname` = ?, `email` = ?, `premium_member` = ?, `country_idcountry` = ? WHERE (`idcustomer` = ?);");
            $stmt->bindValue(1,$customer["firstname"]);
            $stmt->bindValue(2,$customer["lastname"]);
            $stmt->bindValue(3,$customer["email"]);
            $stmt->bindValue(4, isset($customer["premium"]) ? 1 : 0);
            $stmt->bindValue(5,$customer["country"]);
            $stmt->bindValue(6,$id);
            $stmt-> execute();

            header("location: customer.php");
        }
    }
?>