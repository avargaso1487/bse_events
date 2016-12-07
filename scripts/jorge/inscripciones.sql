
CREATE TABLE Inscripciones
( 
	Ins_idInscripcion    					int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Par_idParticipante    					int not null,
    Even_idEvento    						int not null,
	Ins_banco							    varchar(50)  NOT NULL,
	Ins_numeroOperacion				        varchar(50)  NOT NULL,
	Ins_fechaPago							date,
	Ins_imagenVoucher       				varchar(100) NOT NULL,
    TipDocPago_idTipoDocumentoPago			INT NOT NULL,
    Paq_idPaquete							INT NOT NULL,
    Ins_descuento							varchar(100)  NOT NULL,
    Ins_MontoTotal							varchar(100)  NOT NULL,
    Ins_condicion							char(1)  NOT NULL,
    foreign key (Par_idParticipante)
    references participante(Par_idParticipante),
    foreign key (Even_idEvento)
    references evento(Even_idEvento),
    foreign key (TipDocPago_idTipoDocumentoPago)
    references TipoDocumentoPago(TipDocPago_idTipoDocumentoPago),
    foreign key (Paq_idPaquete)
    references Paquete(Paq_idPaquete)
);

CREATE TABLE Inscripcion_Actividad
( 
	InsAct_idInscripcionActividad			int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Ins_idInscripcion    					int not null,
	Acti_idActividad    					int NOT NULL,
    foreign key (Ins_idInscripcion)
    references Inscripciones(Ins_idInscripcion),
    foreign key (Acti_idActividad)
    references Actividad(Acti_idActividad)
);
