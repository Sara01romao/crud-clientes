# crud-leads


Tabela banco de dados 


CREATE TABLE `clientes` ( 
cliente_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
cliente_nome varchar(255) NOT NULL, 
cliente_email varchar(255) NOT NULL,
cliente_contato varchar(255) NOT NULL 
) ENGINE=InnoDB;

