-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema helpdesk
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema helpdesk
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `helpdesk` DEFAULT CHARACTER SET utf8 ;
USE `helpdesk` ;

-- -----------------------------------------------------
-- Table `helpdesk`.`tb_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `icone` VARCHAR(245) NOT NULL,
  `whats` TINYINT(4) NOT NULL DEFAULT 0,
  `web` TINYINT(4) NOT NULL DEFAULT 0,
  `texto` TINYINT(4) NOT NULL DEFAULT 0,
  `produtos` TINYINT(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_setor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_setor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `endereco` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(245) NOT NULL,
  `fone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_departamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `endereco` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(245) NOT NULL,
  `fone` VARCHAR(45) NULL DEFAULT NULL,
  `tb_setor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_departamento_tb_setor_idx` (`tb_setor_id` ASC),
  CONSTRAINT `fk_tb_departamento_tb_setor`
    FOREIGN KEY (`tb_setor_id`)
    REFERENCES `helpdesk`.`tb_setor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_pessoa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `fone` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_chamado` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `descricao` LONGTEXT NOT NULL,
  `tb_categoria_id` INT(11) NOT NULL,
  `finalizado` TINYINT(4) NOT NULL DEFAULT 0,
  `data_finalizado` DATE NULL DEFAULT NULL,
  `hora_finalizado` TIME NULL DEFAULT NULL,
  `finalizado_como` VARCHAR(245) NULL DEFAULT NULL,
  `tb_pessoa_id` INT(11) NOT NULL,
  `tb_departamento_id` INT(11) NOT NULL,
  `protocolo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_chamado_tb_categoria1_idx` (`tb_categoria_id` ASC),
  INDEX `fk_tb_chamado_tb_pessoa1_idx` (`tb_pessoa_id` ASC),
  INDEX `fk_tb_chamado_tb_departamento1_idx` (`tb_departamento_id` ASC),
  CONSTRAINT `fk_tb_chamado_tb_categoria1`
    FOREIGN KEY (`tb_categoria_id`)
    REFERENCES `helpdesk`.`tb_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_departamento1`
    FOREIGN KEY (`tb_departamento_id`)
    REFERENCES `helpdesk`.`tb_departamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_pessoa1`
    FOREIGN KEY (`tb_pessoa_id`)
    REFERENCES `helpdesk`.`tb_pessoa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_anexo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_anexo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `anexo` VARCHAR(245) NOT NULL,
  `descricao` VARCHAR(245) NOT NULL,
  `tb_chamado_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_anexo_tb_chamado1_idx` (`tb_chamado_id` ASC),
  CONSTRAINT `fk_tb_anexo_tb_chamado1`
    FOREIGN KEY (`tb_chamado_id`)
    REFERENCES `helpdesk`.`tb_chamado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_botcadastro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_botcadastro` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fone` VARCHAR(45) NOT NULL,
  `parametro` VARCHAR(45) NOT NULL,
  `valor` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_botchamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_botchamado` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pessoa` INT(11) NOT NULL,
  `parametro` VARCHAR(45) NOT NULL,
  `valor` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_categoria_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_categoria_produto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_empresa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `cnpj` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_estoque` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(145) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_fabricante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_fabricante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `admin` TINYINT(4) NOT NULL DEFAULT 0,
  `chamados` TINYINT(4) NOT NULL DEFAULT 0,
  `estoque` TINYINT(4) NOT NULL DEFAULT 0,
  `patrimonio` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_lista_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_lista_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tb_categoria_id` INT(11) NOT NULL,
  `tb_usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_lista_categoria_tb_categoria1_idx` (`tb_categoria_id` ASC),
  INDEX `fk_tb_lista_categoria_tb_usuario1_idx` (`tb_usuario_id` ASC),
  CONSTRAINT `fk_tb_lista_categoria_tb_categoria1`
    FOREIGN KEY (`tb_categoria_id`)
    REFERENCES `helpdesk`.`tb_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_lista_categoria_tb_usuario1`
    FOREIGN KEY (`tb_usuario_id`)
    REFERENCES `helpdesk`.`tb_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_produto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(145) NOT NULL,
  `un_medida` VARCHAR(45) NOT NULL,
  `qtd_minima` INT NOT NULL DEFAULT 0,
  `tb_estoque_id` INT(11) NOT NULL,
  `tb_categoria_produto_id` INT(11) NOT NULL,
  `imagem` VARCHAR(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_produto_tb_estoque1_idx` (`tb_estoque_id` ASC),
  INDEX `fk_tb_produto_tb_categoria_produto1_idx` (`tb_categoria_produto_id` ASC),
  CONSTRAINT `fk_tb_produto_tb_categoria_produto1`
    FOREIGN KEY (`tb_categoria_produto_id`)
    REFERENCES `helpdesk`.`tb_categoria_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_estoque1`
    FOREIGN KEY (`tb_estoque_id`)
    REFERENCES `helpdesk`.`tb_estoque` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_lista_fabricante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_lista_fabricante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tb_fabricante_id` INT(11) NOT NULL,
  `tb_produto_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_lista_fabricante_tb_fabricante1_idx` (`tb_fabricante_id` ASC),
  INDEX `fk_tb_lista_fabricante_tb_produto1_idx` (`tb_produto_id` ASC),
  CONSTRAINT `fk_tb_lista_fabricante_tb_fabricante1`
    FOREIGN KEY (`tb_fabricante_id`)
    REFERENCES `helpdesk`.`tb_fabricante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_lista_fabricante_tb_produto1`
    FOREIGN KEY (`tb_produto_id`)
    REFERENCES `helpdesk`.`tb_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_lista_produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_lista_produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tb_chamado_id` INT(11) NOT NULL,
  `tb_produto_id` INT(11) NOT NULL,
  `qtd` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_lista_produtos_tb_chamado1_idx` (`tb_chamado_id` ASC),
  INDEX `fk_tb_lista_produtos_tb_produto1_idx` (`tb_produto_id` ASC),
  CONSTRAINT `fk_tb_lista_produtos_tb_chamado1`
    FOREIGN KEY (`tb_chamado_id`)
    REFERENCES `helpdesk`.`tb_chamado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_lista_produtos_tb_produto1`
    FOREIGN KEY (`tb_produto_id`)
    REFERENCES `helpdesk`.`tb_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_tipo_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_tipo_material` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_material` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(245) NOT NULL,
  `patrimonio` VARCHAR(45) NOT NULL,
  `tb_departamento_id` INT(11) NOT NULL,
  `local` VARCHAR(245) NOT NULL,
  `tb_tipo_material_id` INT(11) NOT NULL,
  `data_cadastro` DATE NOT NULL,
  `novo` TINYINT(4) NOT NULL DEFAULT 0,
  `ativo` TINYINT(4) NOT NULL DEFAULT 0,
  `motivo_inativo` VARCHAR(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_material_tb_tipo_material1_idx` (`tb_tipo_material_id` ASC),
  INDEX `fk_tb_material_tb_departamento1_idx` (`tb_departamento_id` ASC),
  CONSTRAINT `fk_tb_material_tb_departamento1`
    FOREIGN KEY (`tb_departamento_id`)
    REFERENCES `helpdesk`.`tb_departamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_material_tb_tipo_material1`
    FOREIGN KEY (`tb_tipo_material_id`)
    REFERENCES `helpdesk`.`tb_tipo_material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_manutencao_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_manutencao_material` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `obs` VARCHAR(245) NULL DEFAULT NULL,
  `tb_material_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_manutencao_material_tb_material1_idx` (`tb_material_id` ASC),
  CONSTRAINT `fk_tb_manutencao_material_tb_material1`
    FOREIGN KEY (`tb_material_id`)
    REFERENCES `helpdesk`.`tb_material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_entrada` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `documento` VARCHAR(45) NOT NULL,
  `tb_empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_entrada_tb_empresa1_idx` (`tb_empresa_id` ASC),
  CONSTRAINT `fk_tb_entrada_tb_empresa1`
    FOREIGN KEY (`tb_empresa_id`)
    REFERENCES `helpdesk`.`tb_empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_produto_entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_produto_entrada` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tb_produto_id` INT(11) NOT NULL,
  `valor_un` VARCHAR(45) NOT NULL DEFAULT 0,
  `tb_fabricante_id` INT(11) NOT NULL,
  `qtd` INT(11) NOT NULL,
  `tb_entrada_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_produto_entrada_tb_fabricante1_idx` (`tb_fabricante_id` ASC),
  INDEX `fk_tb_produto_entrada_tb_produto1_idx` (`tb_produto_id` ASC),
  INDEX `fk_tb_produto_entrada_tb_entrada1_idx` (`tb_entrada_id` ASC),
  CONSTRAINT `fk_tb_produto_entrada_tb_fabricante1`
    FOREIGN KEY (`tb_fabricante_id`)
    REFERENCES `helpdesk`.`tb_fabricante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_entrada_tb_produto1`
    FOREIGN KEY (`tb_produto_id`)
    REFERENCES `helpdesk`.`tb_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_entrada_tb_entrada1`
    FOREIGN KEY (`tb_entrada_id`)
    REFERENCES `helpdesk`.`tb_entrada` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_saida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_saida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `documento` VARCHAR(245) NOT NULL,
  `tb_departamento_id` INT(11) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_saida_tb_departamento1_idx` (`tb_departamento_id` ASC),
  CONSTRAINT `fk_tb_saida_tb_departamento1`
    FOREIGN KEY (`tb_departamento_id`)
    REFERENCES `helpdesk`.`tb_departamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_produto_saida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_produto_saida` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tb_produto_entrada_id` INT(11) NOT NULL,
  `qtd` INT(11) NOT NULL,
  `tb_saida_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_lista_produto_saida_tb_produto_entrada1_idx` (`tb_produto_entrada_id` ASC),
  INDEX `fk_tb_produto_saida_tb_saida1_idx` (`tb_saida_id` ASC),
  CONSTRAINT `fk_tb_lista_produto_saida_tb_produto_entrada1`
    FOREIGN KEY (`tb_produto_entrada_id`)
    REFERENCES `helpdesk`.`tb_produto_entrada` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_saida_tb_saida1`
    FOREIGN KEY (`tb_saida_id`)
    REFERENCES `helpdesk`.`tb_saida` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `helpdesk`.`tb_resposta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`tb_resposta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `resposta` LONGTEXT NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `tb_chamado_id` INT(11) NOT NULL,
  `nome_pessoa` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tb_resposta_tb_chamado1_idx` (`tb_chamado_id` ASC),
  CONSTRAINT `fk_tb_resposta_tb_chamado1`
    FOREIGN KEY (`tb_chamado_id`)
    REFERENCES `helpdesk`.`tb_chamado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

USE `helpdesk` ;

-- -----------------------------------------------------
-- Placeholder table for view `helpdesk`.`v_produtosaida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `helpdesk`.`v_produtosaida` (`id` INT, `data` INT, `id_produto` INT, `produto` INT, `fabricante` INT, `qtd` INT, `saldo` INT);

-- -----------------------------------------------------
-- View `helpdesk`.`v_produtosaida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `helpdesk`.`v_produtosaida`;
USE `helpdesk`;
CREATE  OR REPLACE VIEW v_produtosaida AS 
SELECT tb_produto_entrada.id, tb_entrada.data, tb_produto.id AS id_produto, tb_produto.nome AS produto, tb_fabricante.nome AS fabricante, tb_produto_entrada.qtd, tb_produto_entrada.qtd - IFNULL((SELECT SUM(tb_produto_saida.qtd) FROM tb_produto_saida WHERE tb_produto_saida.tb_produto_entrada_id = tb_produto_entrada.id),0) AS saldo 
FROM tb_produto_entrada 
INNER JOIN tb_fabricante ON tb_produto_entrada.tb_fabricante_id = tb_fabricante.id 
INNER JOIN tb_entrada ON tb_produto_entrada.tb_entrada_id = tb_entrada.id
INNER JOIN tb_produto ON tb_produto_entrada.tb_produto_id = tb_produto.id;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
