
ALTER TABLE MasterTk.Equipo DROP FOREIGN KEY Equipo_ibfk_1;
ALTER TABLE MasterTk.Equipo
ADD CONSTRAINT Equipo_ibfk_1
FOREIGN KEY (idProyecto) REFERENCES Proyecto (idProyecto) ON DELETE CASCADE;


ALTER TABLE MasterTk.TipoItem DROP FOREIGN KEY TipoItem_ibfk_1;
ALTER TABLE MasterTk.TipoItem
ADD CONSTRAINT TipoItem_ibfk_1
FOREIGN KEY (idProyecto) REFERENCES Proyecto (idProyecto) ON DELETE CASCADE;


ALTER TABLE MasterTk.Estado DROP FOREIGN KEY Estado_ibfk_1;
ALTER TABLE MasterTk.Estado
ADD CONSTRAINT Estado_ibfk_1
FOREIGN KEY (idTipoItem) REFERENCES TipoItem (idTipoItem) ON DELETE CASCADE;




ALTER TABLE MasterTk.EquipoAtencion DROP FOREIGN KEY EquipoAtencion_ibfk_1;
ALTER TABLE MasterTk.EquipoAtencion
ADD CONSTRAINT EquipoAtencion_ibfk_1
FOREIGN KEY (idEquipo) REFERENCES Equipo (idEquipo) ON DELETE CASCADE;



ALTER TABLE MasterTk.EquipoAtencion DROP FOREIGN KEY EquipoAtencion_ibfk_2;
ALTER TABLE MasterTk.EquipoAtencion
ADD CONSTRAINT EquipoAtencion_ibfk_2
FOREIGN KEY (idEstado) REFERENCES Estado (idEstado) ON DELETE CASCADE;


ALTER TABLE MasterTk.UsuarioRolEquipo DROP FOREIGN KEY UsuarioRolEquipo_ibfk_3;
ALTER TABLE MasterTk.UsuarioRolEquipo
ADD CONSTRAINT UsuarioRolEquipo_ibfk_3
FOREIGN KEY (idEquipo) REFERENCES Equipo (idEquipo) ON DELETE CASCADE;

Alter Table Estado Add column estado Int (1) Default 1;