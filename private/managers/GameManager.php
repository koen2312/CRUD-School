<?php
    require_once "../static/database.php";
    
    class GameManager{
        public static function getall(){
            global $con;
            $stmt = $con->prepare("SELECT * FROM ratjetoe.game");
            $stmt->execute();
            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
        public static function getselect($id){
            global $con;
            $stmt = $con->prepare("SELECT customer_game.idcustomer_game, customer_game.game_idgame, game.idgame, game.`name`,platform.`name`as nameplatform FROM customer_game 
            JOIN game ON customer_game.game_idgame=game.idgame 
            JOIN platform ON game.platform_idplatform=platform.idplatform WHERE customer_idcustomer = ?;");
            $stmt->bindValue(1,$id);
            $stmt->execute();

            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
        public static function insert($game,$id){
            global $con;
            $stmt = $con->prepare("INSERT INTO `ratjetoe`.`customer_game` (`customer_idcustomer`, `game_idgame`) VALUES (?, ?);");
            $stmt->bindValue(1,$id);
            $stmt->bindValue(2,$game["game"]);
            $stmt->execute();

            header("location: customer.php");
        }
        public static function delete($id){
            global $con;
            $stmt = $con->prepare("DELETE FROM customer_game WHERE idcustomer_game = ?");
            $stmt->bindValue(1,$id);
            $stmt->execute();

            header("location: customer.php");
        }
        public static function emailselect($id){
            global $con;
            $stmt = $con->prepare("SELECT customer_game.idcustomer_game, customer_game.game_idgame, game.idgame, game.`name` FROM customer_game 
            JOIN game ON customer_game.game_idgame=game.idgame 
            WHERE customer_idcustomer = ?;");
            $stmt->bindValue(1,$id);
            $stmt->execute();

            return $stmt-> fetchAll(PDO::FETCH_OBJ);
        }
    }
?>