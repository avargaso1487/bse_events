use bse_events;

create table if not exists DocumentoPago
(
	DocPago_serieDocumentoPago varchar(10) not null,
    DocPago_numeroDocumentoPago int not null,
    TipDocPago_idTipoDocumentoPago int not null,
    DocPago_estado int not null,
    Par_idParticipante int not null,
    primary key (DocPago_serieDocumentoPago, DocPago_numeroDocumentoPago),
    foreign key (TipDocPago_idTipoDocumentoPago) references TipoDocumentoPago(TipDocPago_idTipoDocumentoPago),
    foreign key (Par_idParticipante) references Participante(Par_idParticipante)
);

create table if not exists DetalleDocumento
(
	DocPago_serieDocumentoPago varchar(10) not null,
    DocPago_numeroDocumentoPago int not null,
    DetaDoc_correlatioDetalleDocumento int not null ,
    Acti_idActividad int not null,
    DetaDoc_precioPago decimal(10,2) not null,
    primary key (DocPago_serieDocumentoPago, DocPago_numeroDocumentoPago,DetaDoc_correlatioDetalleDocumento),
    foreign key (DocPago_serieDocumentoPago,DocPago_numeroDocumentoPago) references DocumentoPago(DocPago_serieDocumentoPago,DocPago_numeroDocumentoPago),
    foreign key (Acti_idActividad) references Actividad(Acti_idActividad)
)