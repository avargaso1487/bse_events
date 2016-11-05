CREATE TABLE Ambiente
( 
	Amb_idAmbiente    int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Amb_descripcion    varchar(50)  NULL ,
	Amb_capacidad      int  NULL ,
	Amb_estado         int  NULL ,
	TipAm_idTipoAmbiente int NULL ,
	Loc_idLocal       int  NULL ,
    foreign key (TipAm_idTipoAmbiente)
    references TipoAmbiente(TipAm_idTipoAmbiente),
    foreign key (Loc_idLocal)
    references LocalA(Loc_idLocal)
);


CREATE TABLE LocalA
(
	Loc_idLocal      int  NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Loc_descripcion    varchar(50)  NULL ,
	Loc_direccion      varchar(50)  NULL 
);


CREATE TABLE TipoAmbiente
( 
	TipAm_idTipoAmbiente int  NOT NULL AUTO_INCREMENT primary key,
	TipAm_descripcion  varchar(50)  NULL 
);

