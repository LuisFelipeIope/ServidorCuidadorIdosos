
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE SCHEMA IF NOT EXISTS `marcosvir_luis` DEFAULT CHARACTER SET utf8mb3 ;
USE `marcosvir_luis` ;

-- -----------------------------------------------------
-- Table `marcosvir_luis`.`escolaridade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcosvir_luis`.`escolaridade` (
  `idEscolaridade` INT NOT NULL,
  `escolaridade` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`idEscolaridade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `marcosvir_luis`.`cuidador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcosvir_luis`.`cuidador` (
  `idCuidador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(145) NOT NULL,
  `celular` VARCHAR(45) NOT NULL,
  `temCurso` TINYINT NULL DEFAULT NULL,
  `cursos` VARCHAR(145) NOT NULL,
  `Escolaridade_idEscolaridade` INT NOT NULL,
  PRIMARY KEY (`idCuidador`),
  UNIQUE INDEX `idCuidador_UNIQUE` (`idCuidador` ASC) VISIBLE,
  INDEX `fk_Cuidador_Escolaridade_idx` (`Escolaridade_idEscolaridade` ASC) VISIBLE,
  CONSTRAINT `fk_Cuidador_Escolaridade`
    FOREIGN KEY (`Escolaridade_idEscolaridade`)
    REFERENCES `marcosvir_luis`.`escolaridade` (`idEscolaridade`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('1', 'Ensino Fundamental Incompleto');
INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('2', 'Ensino Fundamental Completo');
INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('3', 'Ensino Médio Incompleto');
INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('4', 'Ensino Médio Completo');
INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('5', 'Ensino Superior Incompleto');
INSERT INTO `marcosvir_luis`.`escolaridade` (`idEscolaridade`, `escolaridade`) VALUES ('6', 'Ensino Superior Completo');