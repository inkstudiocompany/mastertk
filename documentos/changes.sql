
ALTER TABLE Equipo DROP FOREIGN KEY Equipo_ibfk_1;
ALTER TABLE Equipo
ADD CONSTRAINT Equipo_ibfk_1
FOREIGN KEY (idProyecto) REFERENCES Proyecto (idProyecto) ON DELETE CASCADE;


ALTER TABLE TipoItem DROP FOREIGN KEY TipoItem_ibfk_1;
ALTER TABLE TipoItem
ADD CONSTRAINT TipoItem_ibfk_1
FOREIGN KEY (idProyecto) REFERENCES Proyecto (idProyecto) ON DELETE CASCADE;


ALTER TABLE Estado DROP FOREIGN KEY Estado_ibfk_1;
ALTER TABLE Estado
ADD CONSTRAINT Estado_ibfk_1
FOREIGN KEY (idTipoItem) REFERENCES TipoItem (idTipoItem) ON DELETE CASCADE;




ALTER TABLE EquipoAtencion DROP FOREIGN KEY EquipoAtencion_ibfk_1;
ALTER TABLE EquipoAtencion
ADD CONSTRAINT EquipoAtencion_ibfk_1
FOREIGN KEY (idEquipo) REFERENCES Equipo (idEquipo) ON DELETE CASCADE;



ALTER TABLE EquipoAtencion DROP FOREIGN KEY EquipoAtencion_ibfk_2;
ALTER TABLE EquipoAtencion
ADD CONSTRAINT EquipoAtencion_ibfk_2
FOREIGN KEY (idEstado) REFERENCES Estado (idEstado) ON DELETE CASCADE;


ALTER TABLE UsuarioRolEquipo DROP FOREIGN KEY UsuarioRolEquipo_ibfk_3;
ALTER TABLE UsuarioRolEquipo
ADD CONSTRAINT UsuarioRolEquipo_ibfk_3
FOREIGN KEY (idEquipo) REFERENCES Equipo (idEquipo) ON DELETE CASCADE;

Alter Table Estado Add column estado Int (1) Default 1;
Alter Table TipoItem Add column estado Int (1) Default 1;