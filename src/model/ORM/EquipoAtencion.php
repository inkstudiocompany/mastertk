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
                ->where('EquipoAtencion.idEstado', '=', $idEstado)
                ->select('Usuario.idUsuario', 'Usuario.nombreCompleto', 'UsuarioRolEquipo.idUsuarioRolEquipo')
                ->groupBy('Usuario.nombreCompleto');
        }
    }
