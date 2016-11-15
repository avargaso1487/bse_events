use bse_events;
create table if not exists TipoDocumentoPago(
	TipoDocPago_idTipoDocumentoPago int not null AUTO_INCREMENT primary key,
	TipoDocPago_descripcion varchar(200) not null
	
);

create table DocumentoPago
(
	DocPago_serieDocumentoPago varchar(10) not null,
    DocPago_numeroDocumentoPago int not null,
    TipoDocPago_idTipoDocumentoPago int not null,
    DocPago_estado int not null,
    Par_idParticipante int not null,
    primary key (DocPago_serieDocumentoPago, DocPago_numeroDocumentoPago),
    foreign key (TipoDocPago_idTipoDocumentoPago) references TipoDocumentoPago(TipoDocPago_idTipoDocumentoPago),
    foreign key (Par_idParticipante) references Participante(Par_idParticipante)
);

create table DetalleDocumento
(
	DocPago_serioDocumentoPago varchar(10) not null,
    DocPago_numeroDocumento int not null,
    DetaDoc_correlatioDetalleDocumento int not null auto_increment ,
    Acti_idActividad int not null,
    DetaDoc_precioPago decimal(10,2),
    primary key (DocPago_serieDocumentoPago, DocPago_numeroDocumentoPago,DetaDoc_correlatioDetalleDocumento),
    foreign key (DocPago_serieDocumentoPago) references DocumentoPago(DocPago_serieDocumentoPago),
    foreign key (DocPago_numeroDocumentoPago) references DocumentoPago(DocPago_numeroDocumentoPago),
    foreign key (Acti_idActividad) references Actividad(Acti_idActividad)
)