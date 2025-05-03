SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `dbpuskesmas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `dbpuskesmas` ;

-- -----------------------------------------------------
-- Table `dbpuskesmas`.`kecamatan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`kecamatan` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nama` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpuskesmas`.`kelurahan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`kelurahan` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nama` VARCHAR(45) NOT NULL ,
  `kecamatan_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_kelurahan_kecamatan` (`kecamatan_id` ASC) ,
  CONSTRAINT `fk_kelurahan_kecamatan`
    FOREIGN KEY (`kecamatan_id` )
    REFERENCES `dbpuskesmas`.`kecamatan` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpuskesmas`.`pasien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`pasien` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `kode` VARCHAR(10) NOT NULL ,
  `nama` VARCHAR(45) NOT NULL ,
  `tmp_lahir` VARCHAR(30) NOT NULL ,
  `tgl_lahir` DATE NOT NULL ,
  `gender` CHAR(1) NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `alamat` VARCHAR(100) NOT NULL ,
  `kelurahan_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pasien_kelurahan1` (`kelurahan_id` ASC) ,
  CONSTRAINT `fk_pasien_kelurahan1`
    FOREIGN KEY (`kelurahan_id` )
    REFERENCES `dbpuskesmas`.`kelurahan` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpuskesmas`.`unit_kerja`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`unit_kerja` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nama` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpuskesmas`.`paramedik`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`paramedik` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nama` VARCHAR(45) NOT NULL ,
  `gender` CHAR(1) NOT NULL ,
  `tmp_lahir` VARCHAR(30) NOT NULL ,
  `tgl_lahir` DATE NOT NULL ,
  `kategori` VARCHAR(45) NOT NULL ,
  `telpon` VARCHAR(20) NOT NULL ,
  `alamat` VARCHAR(100) NOT NULL ,
  `unit_kerja_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_paramedik_unit_kerja1` (`unit_kerja_id` ASC) ,
  CONSTRAINT `fk_paramedik_unit_kerja1`
    FOREIGN KEY (`unit_kerja_id` )
    REFERENCES `dbpuskesmas`.`unit_kerja` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpuskesmas`.`periksa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dbpuskesmas`.`periksa` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tanggal` DATE NOT NULL ,
  `berat` DOUBLE NOT NULL ,
  `tinggi` DOUBLE NOT NULL ,
  `tensi` VARCHAR(20) NOT NULL ,
  `keterangan` VARCHAR(100) NOT NULL ,
  `periksacol` VARCHAR(45) NOT NULL ,
  `pasien_id` INT NOT NULL ,
  `paramedik_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_periksa_pasien1` (`pasien_id` ASC) ,
  INDEX `fk_periksa_paramedik1` (`paramedik_id` ASC) ,
  CONSTRAINT `fk_periksa_pasien1`
    FOREIGN KEY (`pasien_id` )
    REFERENCES `dbpuskesmas`.`pasien` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_periksa_paramedik1`
    FOREIGN KEY (`paramedik_id` )
    REFERENCES `dbpuskesmas`.`paramedik` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
