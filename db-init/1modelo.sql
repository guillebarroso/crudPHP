USE tienda;
CREATE TABLE usuarios 
    (id int primary key auto_increment, username varchar(15), 
    password varchar(200), email varchar(40));

CREATE TABLE discos
    (id int primary key auto_increment, titulo varchar(60),
    compositor varchar(60), ismn INT , stock INT,
    genero enum("rock", "rap", "pop", "trap", "jazz", "reggaeton"));
