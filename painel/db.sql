CREATE DATABASE rhotel;

CREATE TABLE hoteis
(
    id INTEGER AUTO_INCREMENT,
    nome VARCHAR (30) NOT NULL,
    localizacao VARCHAR (30) NOT NULL,
    sobre VARCHAR (250) NOT NULL,
    imagemUm VARCHAR (250) NOT NULL,
    imagemDois VARCHAR (250) NOT NULL,
    imagemTres VARCHAR (250) NOT NULL,
    comodidades VARCHAR (100) NOT NULL,

    PRIMARY KEY (id)
);

CREATE TABLE quartos
(
    id INTEGER AUTO_INCREMENT,
    nome VARCHAR (30) NOT NULL,
    preco DECIMAL (10,2) NOT NULL,
    capacidadeHospedes INTEGER NOT NULL,
    quantidadeCamas INTEGER NOT NULL,
    imagemUm VARCHAR (250) NOT NULL,
    imagemDois VARCHAR (250) NOT NULL,
    imagemTres VARCHAR (250) NOT NULL,
    idHotel INTEGER NOT NULL,
    
    PRIMARY KEY (id)
);