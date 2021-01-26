CREATE DATABASE formulario_covid_pmjm;

USE formulario_covid_pmjm;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT,
   	nome VARCHAR(40) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    telefone VARCHAR(15),
	email VARCHAR(40) UNIQUE,
	senha VARCHAR(32),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE dados (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    idade INT(3) NOT NULL,
    sexo ENUM('M', 'F') NOT NULL,
    gestante BIT DEFAULT 0,
    autodeclarado BIT DEFAULT 0,
    trabalho ENUM('Remoto', 'Presencial', 'Misto') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE formulario_covid (
    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    febre BIT NOT NULL,
    dor_no_corpo BIT NOT NULL,
    tosse_seca BIT NOT NULL,
    cansaco BIT NOT NULL,
    dificuldade_para_respirar BIT NOT NULL,
    mensagem VARCHAR(255),
    data_sintomas DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);