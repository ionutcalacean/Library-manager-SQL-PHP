-- Calacean Ionut --
-- Grupa 30229 --
-- subiectul 12 --

create database if not exists biblioteca;

use biblioteca;

CREATE TABLE Persoana
(id_pers double,
nume VARCHAR(30),
telefon double
);

CREATE TABLE Carte
(id_carte double,
titlu VARCHAR(30),
nr_pagini double,
nr_exemplare double,
gen VARCHAR(20),
rezumat VARCHAR(150)
);

CREATE TABLE Imprumut
(id_carte double,
id_imp double,
datai DATE,
datar DATE DEFAULT NULL,
nr_zile double
);

CREATE TABLE Autor
(id_carte double,
id_aut double
);

INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(101,'Mihai Eminescu','')
;
INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(102,'Mircea Eliade','')
;
INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(103,'Ion Creanga','')
;
INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(201,'Raul Marchis','0746263614')
;
INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(202,'Paul Filip','0723516111')
;
INSERT INTO Persoana(id_pers,nume,telefon)
VALUES(203,'Ionut Calacean','0746656076')
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1001,'Luceafarul',120,10,'VERSURI','')
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1002,'Maitreyi',185,5,'BELETRISTICA','')
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1004,'Sacrul si profanul',210,15,'BELETRISTICA','')
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1003,'Corpul uman',25,2,'MEDICINA','alcatuirea omului')
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1005,'Amintiri din copilarie',114,25,'BELETRISTICA','')
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1001,201,'2018-11-25',DEFAULT,10)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1005,202,'2018-11-26',DEFAULT,15)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1004,203,'2018-11-27',DEFAULT,5)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1002,201,'2018-11-21','2018-12-13',8)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1003,203,'2018-11-24','2018-12-02',2)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1001,202,'2018-11-22',DEFAULT,15)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1001,203,'2018-11-23',DEFAULT,25)
;
INSERT INTO imprumut(id_carte,id_imp,datai,datar,nr_zile)
VALUES(1002,203,'2018-11-10',DEFAULT,5)
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1001,101)
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1002,102)
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1004,102)
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1005,103)
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1006,'India',340,9,'BELETRISTICA','')
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1006,102)
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1005,102)
;
INSERT INTO carte(id_carte,titlu,nr_pagini,nr_exemplare,gen,rezumat)
VALUES(1007,'Visul',294,100,'SF','')
;
INSERT INTO persoana(id_pers,nume,telefon)
VALUES(104,'Mircea Cartarescu','0211234567')
;
INSERT INTO autor(id_carte,id_aut)
VALUES(1007,104)
;



ALTER TABLE Persoana ADD CONSTRAINT persoana_id_pers_pk PRIMARY KEY (id_pers);
ALTER TABLE Carte ADD CONSTRAINT carte_id_carte_pk PRIMARY KEY (id_carte);
ALTER TABLE Imprumut ADD CONSTRAINT imprumut_datai_pk PRIMARY KEY(datai,id_carte);
ALTER TABLE Imprumut  ADD
      CONSTRAINT imprumut_id_carte_fk FOREIGN KEY(id_carte) REFERENCES Carte(id_carte);
ALTER TABLE Imprumut ADD 
      CONSTRAINT imprumut_id_imp_fk FOREIGN KEY(id_imp) REFERENCES Persoana(id_pers);
ALTER TABLE Imprumut ADD
      CONSTRAINT imprumut_nr_zile_ck CHECK (nr_zile>0);
ALTER TABLE Autor ADD 
      CONSTRAINT autor_pk PRIMARY KEY(id_carte,id_aut);
ALTER TABLE Autor ADD 
      CONSTRAINT autor_id_carte_fk FOREIGN KEY(id_carte) REFERENCES Carte(id_carte);
ALTER TABLE Autor ADD
      CONSTRAINT autor_id_aut_fk FOREIGN KEY(id_aut) REFERENCES Persoana(id_pers);
ALTER TABLE Carte ADD
      CONSTRAINT carte_nr_exemplare_ck CHECK (nr_exemplare>1);
ALTER TABLE Carte ADD
      CONSTRAINT carte_gen_pagini_ck CHECK((gen='BELETRISTICA' AND nr_pagini>30) OR (gen !='BELETRISTICA'));





