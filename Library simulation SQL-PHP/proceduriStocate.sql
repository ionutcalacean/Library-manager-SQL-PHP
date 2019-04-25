CREATE PROCEDURE `NrPaginiPar`() 
NOT DETERMINISTIC NO SQL
 SQL SECURITY DEFINER 
 SELECT titlu,gen,nr_pagini 
 FROM Carte
 WHERE MOD(nr_pagini,2)=0 
 ORDER BY nr_pagini,gen;
 
 
 CREATE PROCEDURE `RestituireIntarziata`() 
 NOT DETERMINISTIC NO SQL 
 SQL SECURITY DEFINER 
 SELECT id_carte,id_imp, DATEDIFF(datar,datai)-nr_zile as 'Numar zile intarziere' 
 FROM imprumut 
 WHERE (datar-datai)>nr_zile 
 ORDER BY 'Numar zile intarziere' DESC;
 
 CREATE PROCEDURE `gasesteCarti`() 
 NOT DETERMINISTIC NO SQL 
 SQL SECURITY DEFINER 
 SELECT * 
 FROM carte;
 
 CREATE PROCEDURE `persoaneCartiNerestituite`() 
 NOT DETERMINISTIC NO SQL 
 SQL SECURITY DEFINER 
 SELECT DISTINCT p.nume as nume,p.telefon as telefon 
 FROM persoana p JOIN imprumut i 
 ON (p.id_pers=i.id_imp) 
 WHERE datar is NULL;
 
 CREATE PROCEDURE `cartiMultiAutor`() 
 NOT DETERMINISTIC NO SQL 
 SQL SECURITY DEFINER 
 SELECT DISTINCT id_carte 
 FROM autor a WHERE EXISTS 
 (SELECT * 
 FROM autor b 
 WHERE a.id_aut!=b.id_aut AND a.id_carte=b.id_carte);