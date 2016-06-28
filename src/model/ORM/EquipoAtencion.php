<?php

    namespace Model\ORM;

    class EquipoAtencion extends EntityBase{

        protected $table = "EquipoAtencion";
        protected $primaryKey = 'idEquipoAtencion';

        public function equipo(){
           return $this->belongsTo('Model\ORM\Equipo','idEquipo','idEquipo');
        }

        public function estado(){
            return $this->belongsTo('Model\ORM\Estado','idEstado','idEstado');
        }

        public function scopeUsersByState($query, $idEstado)
        {
            return $query
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'EquipoAtencion.idEquipo')
                ->join('Usuario', 'Usuario.idUsuario', '=', 'UsuarioRolEquipo.idUsuario')
                ->join('Equipo', 'Equipo.idEquipo','=','UsuarioRolEquipo.idEquipo')
                ->where('EquipoAtencion.idEstado', '=', $idEstado)
                ->where('UsuarioRolEquipo.activo',1)
                ->where('Equipo.estado',1)
                -> selectRaw("Usuario.idUsuario, Usuario.nombreCompleto,
                                concat(Usuario.nombreCompleto, ' (', Equipo.nombreEquipo,
                                        CASE WHEN UsuarioRolEquipo.esLider= 1 THEN ' - Lider' ELSE '' END , ')'
                                ) as descripcion"
                )
                ->groupBy('Usuario.nombreCompleto')
                ->orderBy('UsuarioRolEquipo.esLider','desc');
        }

        public function scopeEquiposActivos(){
            return $this -> equipo()
                            -> where('estado',1);
        }
    }
