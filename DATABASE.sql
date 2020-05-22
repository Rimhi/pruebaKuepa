CREATE DATABASE IF NOT EXISTS proyectoSymfony;
USE proyectoSymfony;

CREATE TABLE IF NOT EXISTS programs(
    id int(1) auto_increment not null,
    name  varchar(100),
    CONSTRAINT pk_programs PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS users(
    id int(255) auto_increment not null,
    role varchar(10),
    name varchar(100),
    surname varchar(100),
    email varchar(200),
    phone varchar(15),
    program_id int(10),
    password varchar(255),
    call varchar(5),
    created_at datetime,
    remember_token varchar(100),
    updated_at timestamp,
    CONSTRAINT pk_users PRIMARY KEY(id),
    CONSTRAINT fk_program_user FOREIGN KEY(program_id)  REFERENCES programs(id)
)ENGINE=InnoDb;


INSERT INTO programs VALUES (1,'Bachillerato');
INSERT INTO programs VALUES (2,'Ingles');
INSERT INTO programs VALUES (3,'Preicfes');
INSERT INTO users VALUES (NULL,'ROLE_USER','Ricardo','Monterrosa','rimhi7@gmail.com',3002729843,2,'admin','no',CURTIME(),null,CURTIME());
INSERT INTO users VALUES (NULL,'ROLE_USER','Ricardo','Monterrosa','rimhi7@hotmail.com',3107306474,1,'admin','no',CURTIME(),null,CURTIME());
INSERT INTO users VALUES (NULL,'ROLE_USER','Ricardo','Monterrosa','rimhi8@hotmail.com',3107306475,1,'admin','no',CURTIME(),null,CURTIME());
INSERT INTO users VALUES (NULL,'ROLE_USER','Ricardo','Monterrosa','rimhi9@hotmail.com',3107306476,1,'admin','no',CURTIME(),null,CURTIME());
INSERT INTO users VALUES (NULL,'ROLE_USER','Ricardo','Monterrosa','rimhi10@hotmail.com',3107306477,1,'admin','no',CURTIME(),null,CURTIME());