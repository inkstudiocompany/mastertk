<?php

    namespace Model\ORM;

    class UsuarioRolEquipo extends EntityBase{

        protected $table = "UsuarioRolEquipo";
        protected $primaryKey = 'idUsuarioRolEquipo';

        public function usuario(){
            return $this->belongsTo('Model\ORM\Usuario','idUsuario','idUsuario');
        }

        public function rol(){
            return $this->belongsTo('Model\ORM\Rol', 'idRol', 'idRol');
        }

        public function equipo(){
            return $this->belongsTo('Model\ORM\Equipo','idEquipo','idEquipo');
        }

        public function itemsAsignados(){
            return $this->hasMany('Model\ORM\Item', 'responsable', 'idUsuarioRolEquipo');
        }

        public static function scopeBuscarUsuarioEquipo($query, $idUsuario,$idEquipo)
        {
            return $query->where('idUsuario','=', $idUsuario)
                ->where('idEquipo', '=',$idEquipo);
        }

        public function scopeMiniUsuario()
        {
            return $this ->usuario() -> select(['idUsuario','nombreCompleto']);
        }
    }
