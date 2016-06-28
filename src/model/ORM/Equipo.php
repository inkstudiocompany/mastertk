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
                ->select('Usuario.*');
        }


        public function scopeLiderEquipo(){
            return $this ->usuarioRolEquipo()
                -> with(['usuario'])
                -> where('activo',1)
                -> where('esLider',1);
        }


        public function scopeCuentaItemsAsignados(){
            return $this ->usuarioRolEquipo()
                -> join("Item","UsuarioRolEquipo.idUsuarioRolEquipo" ,"=","Item.responsable")
                -> selectRaw('count(idItem) as cuentaItems, idEquipo')
                -> groupBy('idEquipo');
        }

        public function scopeCuentaItemsAtendidos(){
            return $this ->usuarioRolEquipo()
                -> join("TransicionItem","UsuarioRolEquipo.idUsuarioRolEquipo" ,"=","TransicionItem.responsable")
                -> selectRaw('count(idItem) as cuentaItems, idEquipo')
                -> groupBy('idEquipo');
        }

        public function scopeUsuariosRolActivos(){
            return $this -> usuarioRolEquipo() -> where('activo',1);
        }

        public function scopeUsuarios(){
            return $this -> usuarioRolEquipo() -> with(['rol','miniUsuario']) -> where('UsuarioRolEquipo.activo',1);
        }
    }