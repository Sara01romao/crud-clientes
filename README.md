# crud-clientes







## 🎲 Banco de dados 
Tabela Clientes
```
CREATE TABLE `clientes` ( 
clientes_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
clientes_nome varchar(255) NOT NULL, 
clientes_email varchar(100) NOT NULL,
clientes_contato varchar(11) NOT NULL 
) ENGINE=InnoDB;

```

Inserir Registros Iniciais
```
INSERT INTO `clientes` (`clientes_id`, `clientes_nome`, `clientes_email`, `clientes_contato`) VALUES
(1, 'Ana Gomes', 'ana-contato@gmail.com', '1199999992'),
(2, 'Carlos Daniel', 'carlos-contato@gmail.com', '2199999993'),
(3, 'Simone liu', 'simone-contato@gmail.com', '1199999994'),
(4, 'Lucas Silva', 'lucas-contato@gmail.com', '1899999995'),
(5, 'Diana Liga', 'diana-contato@gmail.com', '1699999996');
```
