INSERT INTO `tarea` (`Tar_idTarea`, `Mod_idModulo`, `Gru_idGrupo`, `Tar_nombre`, `Tar_descripcion`, `Tar_orden`, `Tar_url`, `Tar_estado`) VALUES
(9, 3, 5, 'Listado de eventos', 'Listado de eventos', 1, '.../eventos/lista_eventos.php', 1),
(10, 3, 5, 'Nuevo evento', 'Nuevo evento', 1, '../eventos/registrar_evento.php', 1);

INSERT INTO `permiso` (`Pso_idPermiso`, `Rol_idRol`, `Tar_idTarea`, `Pso_estado`) VALUES
(9, 1, 9, 1),
(10, 1, 10, 1);

