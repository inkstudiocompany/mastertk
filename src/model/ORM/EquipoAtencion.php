<?php

    namespace Model\ORM;

    class EquipoAtencion extends EntityBase{

        protected $table = "EquipoAtencion";
        protected $primaryKey = 'idEquipoAtencion';

        public function equipo(){
            $this->belongsTo('Model\ORM\Equipo','idEquipo','idEquipo');
        }

        public function estado(){
            $this->belongsTo('Model\ORM\Estado','idEstado','idEstado');
        }
    }
