# crud-clientes
![editar](https://github.com/Sara01romao/crud-clientes/assets/46323667/1ed8b061-0bc7-45e5-a353-25f21fc56b41)

## 💻  Sobre o Projeto

A crud de controle de clientes,  objetivo foi praticar o uso do ajax e sweetalert2. 

<br>

## :rocket: Tecnologias Usadas
Front-end 
```
  Bootstrap
  SweetAlert2
  Ajax
```

## Back-end
```
  PHP
```
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
