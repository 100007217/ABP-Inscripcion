-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_abp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_abp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_abp` DEFAULT CHARACTER SET utf8mb4 ;
USE `db_abp` ;

-- -----------------------------------------------------
-- Table `db_abp`.`tbl_tipouse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_abp`.`tbl_tipouse` (
  `id_tipo_use` INT NOT NULL AUTO_INCREMENT,
  `tipo_use` ENUM("Admin", "Common") NULL,
  PRIMARY KEY (`id_tipo_use`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_abp`.`tbl_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_abp`.`tbl_usuario` (
  `id_use` INT(11) NOT NULL AUTO_INCREMENT,
  `nom_use` VARCHAR(45) NOT NULL,
  `apellido_use` VARCHAR(45) NOT NULL,
  `fecha_nac_use` DATE NOT NULL,
  `sexo_use` ENUM("Mujer", "Hombre") NULL,
  `num_movil_use` CHAR(9) NULL,
  `dni_use` CHAR(9) NULL,
  `correo_use` VARCHAR(45) NOT NULL,
  `password_use` VARCHAR(45) NOT NULL,
  `tipo_usuario_fk` INT(11) NULL,
  PRIMARY KEY (`id_use`),
  INDEX `fk_tipousuario_usuario_idx` (`tipo_usuario_fk` ASC),
  CONSTRAINT `fk_tipousuario_usuario`
    FOREIGN KEY (`tipo_usuario_fk`)
    REFERENCES `db_abp`.`tbl_tipouse` (`id_tipo_use`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_abp`.`tbl_barrio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_abp`.`tbl_barrio` (
  `id_bar` INT NOT NULL AUTO_INCREMENT,
  `nombre_bar` VARCHAR(45) NULL,
  PRIMARY KEY (`id_bar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_abp`.`tbl_eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_abp`.`tbl_eventos` (
  `id_eve` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_eve` VARCHAR(50) NULL,
  `fecha_inicio_eve` DATE NULL,
  `fecha_fin_eve` DATE NULL,
  `num_max_pers_eve` INT(5) NULL,
  `edad_min_eve` INT(2) NULL,
  `barrio_eve_fk` INT(11) NULL,
  PRIMARY KEY (`id_eve`),
  INDEX `fk_barrio_eventos_idx` (`barrio_eve_fk` ASC),
  CONSTRAINT `fk_barrio_eventos`
    FOREIGN KEY (`barrio_eve_fk`)
    REFERENCES `db_abp`.`tbl_barrio` (`id_bar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_abp`.`tbl_eventos_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_abp`.`tbl_eventos_usuarios` (
  `id_evento_use` INT(11) NOT NULL AUTO_INCREMENT,
  `id_eve_fk` INT(11) NULL,
  `id_use_fk` INT(11) NULL,
  PRIMARY KEY (`id_evento_use`),
  INDEX `fk_usuario_eventos_usuarios_idx` (`id_use_fk` ASC),
  INDEX `fk_eventos_eventos_usuarios_idx` (`id_eve_fk` ASC),
  CONSTRAINT `fk_usuario_eventos_usuarios`
    FOREIGN KEY (`id_use_fk`)
    REFERENCES `db_abp`.`tbl_usuario` (`id_use`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_eventos_usuarios`
    FOREIGN KEY (`id_eve_fk`)
    REFERENCES `db_abp`.`tbl_eventos` (`id_eve`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;