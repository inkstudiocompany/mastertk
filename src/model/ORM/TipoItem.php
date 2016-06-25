<?php

    namespace Model\ORM;

    class TipoItem extends EntityBase{

        protected $table = "TipoItem";
        protected $primaryKey = 'idTipoItem';

        public function proyecto(){
            return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
        }

        public function estados(){
            return $this ->hasMany('Model\ORM\Estado','idTipoItem','idTipoItem');
        }

        public function tickets(){
            return $this ->hasMany('Model\ORM\Item','idTipoItem','idTipoItem');
        }

        public function scopeTipoItemsProyecto($query, $idProyecto)
        {
            return $query->whereIdproyecto($idProyecto);
        }

        public function scopeEstadosActivos(){
            return $this -> estados() -> where('estado',1);
        }

        public function scopeCuentaTickets(){
            return $this -> tickets()
                -> selectRaw('count(idItem) as cuentaItems, idTipoItem')
                -> groupBy('idTipoItem');
        }

        public  function scopeEstadoInicial(){
            return $this -> estados() -> where('tipoEstado',1);
        }
    }
