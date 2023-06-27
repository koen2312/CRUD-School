-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Ratjetoe
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Ratjetoe
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Ratjetoe` DEFAULT CHARACTER SET utf8 ;
USE `Ratjetoe` ;

-- -----------------------------------------------------
-- Table `Ratjetoe`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`country` (
  `idcountry` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcountry`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ratjetoe`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`customer` (
  `idcustomer` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `premium_member` TINYINT(1) NOT NULL,
  `country_idcountry` INT NOT NULL,
  PRIMARY KEY (`idcustomer`),
  INDEX `fk_customer_country_idx` (`country_idcountry` ASC),
  CONSTRAINT `fk_customer_country`
    FOREIGN KEY (`country_idcountry`)
    REFERENCES `Ratjetoe`.`country` (`idcountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ratjetoe`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `Password_hash` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ratjetoe`.`platform`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`platform` (
  `idplatform` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idplatform`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ratjetoe`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`game` (
  `idgame` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `platform_idplatform` INT NOT NULL,
  PRIMARY KEY (`idgame`),
  INDEX `fk_game_platform1_idx` (`platform_idplatform` ASC),
  CONSTRAINT `fk_game_platform1`
    FOREIGN KEY (`platform_idplatform`)
    REFERENCES `Ratjetoe`.`platform` (`idplatform`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ratjetoe`.`customer_game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ratjetoe`.`customer_game` (
  `idcustomer_game` INT NOT NULL AUTO_INCREMENT,
  `customer_idcustomer` INT NOT NULL,
  `game_idgame` INT NOT NULL,
  PRIMARY KEY (`idcustomer_game`),
  INDEX `fk_customer_game_customer1_idx` (`customer_idcustomer` ASC),
  INDEX `fk_customer_game_game1_idx` (`game_idgame` ASC),
  CONSTRAINT `fk_customer_game_customer1`
    FOREIGN KEY (`customer_idcustomer`)
    REFERENCES `Ratjetoe`.`customer` (`idcustomer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_game_game1`
    FOREIGN KEY (`game_idgame`)
    REFERENCES `Ratjetoe`.`game` (`idgame`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
