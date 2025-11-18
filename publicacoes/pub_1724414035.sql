CREATE TABLE `autor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `autor_publicacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_autor` INT NOT NULL,
  `id_publicacao` INT NOT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `autor_publicacao` 
ADD INDEX `index2` (`id_autor` ASC) VISIBLE;

ALTER TABLE `autor_publicacao` 
ADD INDEX `index3` (`id_publicacao` ASC) VISIBLE;

ALTER TABLE `autor_publicacao` 
ADD CONSTRAINT `fk_autor_publicacao_1`
  FOREIGN KEY (`id_autor`)
  REFERENCES `autor` (`id`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

ALTER TABLE `autor_publicacao` 
ADD CONSTRAINT `fk_autor_publicacao_2`
  FOREIGN KEY (`id_publicacao`)
  REFERENCES `publicacao` (`id`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;

ALTER TABLE `publicacao` 
CHANGE COLUMN `id_tipo` `id_tipo` CHAR(2) NOT NULL ;


ALTER TABLE `publicacao` 
DROP COLUMN `email`,
DROP COLUMN `membro`,
DROP COLUMN `instituicao`;

