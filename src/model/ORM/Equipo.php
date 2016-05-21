<?php

    namespace Model\ORM;

    class Equipo extends EntityBase{

        protected $table = "Equipo";
        protected $primaryKey = 'idEquipo';

        public function proyecto(){
            return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
        }

        public function usuarioRolEquipo(){
            return $this->hasMany('Model\ORM\UsuarioRolEquipo','idEquipo','idEquipo');
        }

        public function scopeLider($query, $id){
            $query->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
                ->join('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
                ->where('UsuarioRolEquipo.esLider', '=', $id)
                ->select('Usuario.*')
                ;
        }
    }