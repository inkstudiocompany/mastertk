-- MySQL Script generated by MySQL Workbench
-- Sat Jan 16 18:55:05 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema masterdb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `masterdb` ;

-- -----------------------------------------------------
-- Schema masterdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `masterdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `masterdb` ;

-- -----------------------------------------------------
-- Table `masterdb`.`Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Roles` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Roles` (
  `idRoles` INT NOT NULL,
  `nombreRol` VARCHAR(45) NULL,
  PRIMARY KEY (`idRoles`),
  UNIQUE INDEX `idRoles_UNIQUE` (`idRoles` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Usuario` (
  `idUsuario` INT NOT NULL,
  `nombreCompleto` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `dni` VARCHAR(15) NULL,
  `idRolPrincipal` INT NOT NULL,
  `usuario` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`idUsuario`, `idRolPrincipal`),
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC),
  INDEX `fk_Usuario_Roles1_idx` (`idRolPrincipal` ASC),
  CONSTRAINT `fk_Usuario_Roles1`
    FOREIGN KEY (`idRolPrincipal`)
    REFERENCES `masterdb`.`Roles` (`idRoles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Proyecto` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Proyecto` (
  `idProyecto` INT NOT NULL,
  `nomProyecto` VARCHAR(255) NULL,
  `objProyecto` VARCHAR(255) NULL,
  `inicioProyecto` DATETIME NULL,
  `finProyecto` DATETIME NULL,
  `productivoProyecto` TINYINT(1) NULL,
  `idLider` INT NOT NULL,
  UNIQUE INDEX `idProyecto_UNIQUE` (`idProyecto` ASC),
  PRIMARY KEY (`idProyecto`, `idLider`),
  INDEX `fk_Proyecto_Usuario1_idx` (`idLider` ASC),
  CONSTRAINT `fk_Proyecto_Usuario1`
    FOREIGN KEY (`idLider`)
    REFERENCES `masterdb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`TipoItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`TipoItem` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`TipoItem` (
  `idProyecto` INT NOT NULL,
  `idTipoItem` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  INDEX `fk_TipoItem_Proyecto1_idx` (`idProyecto` ASC),
  PRIMARY KEY (`idTipoItem`, `idProyecto`),
  UNIQUE INDEX `idTipoItem_UNIQUE` (`idTipoItem` ASC),
  CONSTRAINT `fk_TipoItem_Proyecto1`
    FOREIGN KEY (`idProyecto`)
    REFERENCES `masterdb`.`Proyecto` (`idProyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`Estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Estado` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Estado` (
  `idTipoItem` INT NOT NULL,
  `idEstado` INT NOT NULL,
  `nombreEstado` VARCHAR(255) NULL,
  `tipoEstado` CHAR(1) NULL,
  INDEX `fk_Estado_TipoItem1_idx` (`idTipoItem` ASC),
  PRIMARY KEY (`idEstado`),
  UNIQUE INDEX `idEstado_UNIQUE` (`idEstado` ASC),
  CONSTRAINT `fk_Estado_TipoItem1`
    FOREIGN KEY (`idTipoItem`)
    REFERENCES `masterdb`.`TipoItem` (`idTipoItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`Equipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Equipo` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Equipo` (
  `idEquipo` INT NOT NULL,
  `idProyecto` INT NOT NULL,
  `nombreEquipo` VARCHAR(255) NULL,
  PRIMARY KEY (`idEquipo`, `idProyecto`),
  INDEX `fk_Equipo_Proyecto1_idx` (`idProyecto` ASC),
  CONSTRAINT `fk_Equipo_Proyecto1`
    FOREIGN KEY (`idProyecto`)
    REFERENCES `masterdb`.`Proyecto` (`idProyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`UsuarioRolEquipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`UsuarioRolEquipo` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`UsuarioRolEquipo` (
  `Equipo_idEquipo` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `idRol` INT NOT NULL,
  `UsuarioRolEquipocol` VARCHAR(45) NULL,
  `esLider` TINYINT(1) NULL,
  `idUsuarioRolEquipo` INT NOT NULL,
  PRIMARY KEY (`idUsuarioRolEquipo`),
  INDEX `fk_Equipo_has_Usuario_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Equipo_has_Usuario_Equipo1_idx` (`Equipo_idEquipo` ASC),
  INDEX `fk_UsuarioEquipo_Roles1_idx` (`idRol` ASC),
  CONSTRAINT `fk_Equipo_has_Usuario_Equipo1`
    FOREIGN KEY (`Equipo_idEquipo`)
    REFERENCES `masterdb`.`Equipo` (`idEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Equipo_has_Usuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `masterdb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsuarioEquipo_Roles1`
    FOREIGN KEY (`idRol`)
    REFERENCES `masterdb`.`Roles` (`idRoles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`Item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`Item` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`Item` (
  `idProyecto` INT NOT NULL,
  `idItem` INT NOT NULL,
  `tituloItem` VARCHAR(255) NOT NULL,
  `descItem` VARCHAR(255) NULL,
  `fechacreacion` DATETIME NULL,
  `idTipoItem` INT NOT NULL,
  `prioridad` VARCHAR(45) NULL,
  `estadoActual` INT NOT NULL,
  `responsable` INT NOT NULL,
  INDEX `fk_Item_Proyecto_idx` (`idProyecto` ASC),
  PRIMARY KEY (`idItem`),
  UNIQUE INDEX `idItem_UNIQUE` (`idItem` ASC),
  INDEX `fk_Item_TipoItem1_idx` (`idTipoItem` ASC),
  INDEX `fk_Item_Estado1_idx` (`estadoActual` ASC),
  INDEX `fk_Item_UsuarioRolEquipo1_idx` (`responsable` ASC),
  CONSTRAINT `fk_Item_Proyecto`
    FOREIGN KEY (`idProyecto`)
    REFERENCES `masterdb`.`Proyecto` (`idProyecto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_TipoItem1`
    FOREIGN KEY (`idTipoItem`)
    REFERENCES `masterdb`.`TipoItem` (`idTipoItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_Estado1`
    FOREIGN KEY (`estadoActual`)
    REFERENCES `masterdb`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_UsuarioRolEquipo1`
    FOREIGN KEY (`responsable`)
    REFERENCES `masterdb`.`UsuarioRolEquipo` (`idUsuarioRolEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`EstadoSiguiente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`EstadoSiguiente` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`EstadoSiguiente` (
  `idEstadoActual` INT NOT NULL,
  `idEstadoSiguiente` INT NOT NULL,
  PRIMARY KEY (`idEstadoSiguiente`, `idEstadoActual`),
  INDEX `fk_Estado_has_Estado_Estado2_idx` (`idEstadoSiguiente` ASC),
  INDEX `fk_Estado_has_Estado_Estado1_idx` (`idEstadoActual` ASC),
  CONSTRAINT `fk_Estado_has_Estado_Estado1`
    FOREIGN KEY (`idEstadoActual`)
    REFERENCES `masterdb`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estado_has_Estado_Estado2`
    FOREIGN KEY (`idEstadoSiguiente`)
    REFERENCES `masterdb`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`TransicionItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`TransicionItem` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`TransicionItem` (
  `idTransicionItem` INT NOT NULL,
  `fecha` DATETIME NULL,
  `idEstado` INT NOT NULL,
  `Item_idItem` INT NOT NULL,
  `responsable` INT NOT NULL,
  `asignado` INT NOT NULL,
  `comentario` VARCHAR(255) NULL,
  PRIMARY KEY (`idTransicionItem`),
  UNIQUE INDEX `idTransicionItem_UNIQUE` (`idTransicionItem` ASC),
  INDEX `fk_TransicionItem_Estado1_idx` (`idEstado` ASC),
  INDEX `fk_TransicionItem_Item1_idx` (`Item_idItem` ASC),
  INDEX `fk_TransicionItem_UsuarioRolEquipo1_idx` (`responsable` ASC),
  INDEX `fk_TransicionItem_UsuarioRolEquipo2_idx` (`asignado` ASC),
  CONSTRAINT `fk_TransicionItem_Estado1`
    FOREIGN KEY (`idEstado`)
    REFERENCES `masterdb`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TransicionItem_Item1`
    FOREIGN KEY (`Item_idItem`)
    REFERENCES `masterdb`.`Item` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TransicionItem_UsuarioRolEquipo1`
    FOREIGN KEY (`responsable`)
    REFERENCES `masterdb`.`UsuarioRolEquipo` (`idUsuarioRolEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TransicionItem_UsuarioRolEquipo2`
    FOREIGN KEY (`asignado`)
    REFERENCES `masterdb`.`UsuarioRolEquipo` (`idUsuarioRolEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `masterdb`.`EquipoEstado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `masterdb`.`EquipoEstado` ;

CREATE TABLE IF NOT EXISTS `masterdb`.`EquipoEstado` (
  `idEquipo` INT NOT NULL,
  `idEstado` INT NOT NULL,
  PRIMARY KEY (`idEquipo`, `idEstado`),
  INDEX `fk_Equipo_has_Estado_Estado1_idx` (`idEstado` ASC),
  INDEX `fk_Equipo_has_Estado_Equipo1_idx` (`idEquipo` ASC),
  CONSTRAINT `fk_Equipo_has_Estado_Equipo1`
    FOREIGN KEY (`idEquipo`)
    REFERENCES `masterdb`.`Equipo` (`idEquipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Equipo_has_Estado_Estado1`
    FOREIGN KEY (`idEstado`)
    REFERENCES `masterdb`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
