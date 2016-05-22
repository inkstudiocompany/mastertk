<?php
	namespace Model\ORM;

	class Usuario extends EntityBase{
            
		protected $table = "Usuario";
		protected $primaryKey = "idUsuario";

		public function rolPrincipal(){
			return $this->belongsTo('Model\ORM\Rol','idRolPrincipal','idRol');
		}

		public function lidera(){
			return $this->belongsTo('Model\ORM\Proyecto','idUsuario','idLider');
		}

		public function equipoRol(){
			return $this->hasMany('Model\ORM\UsuarioRolEquipo','idUsuario','idUsuario');
		}

		public function usuarioEquipo(){
			return $this ->hasMany('Model\ORM\UsuarioEquipo','idUsuario','idEquipo');
		}

		public function transiciones() {
			return $this->hasMany('Model\ORM\TransicionItem', 'idUsuario', 'idUsuario');
		}

        public function comentarios() {
            return $this->hasMany('Model\ORM\Comentario', 'idUsuario', 'idUsuario');
        }

        public function scopeAuth($query, $email, $password)
		{
            return $query->whereRaw(
                '(email = \'' . $email . '\' OR usuario = \'' . $email . '\') AND password = \'' . $password . '\''
            );
		}

        public function scopeAccessTockenAuth($query, $access_tocken)
        {
            return $query->whereRaw(
                'accessToken = \'' . $access_tocken . '\''
            );
        }

        public function scopeHistory($query, $id)
        {
            return $query
                ->join('Item', 'Item.responsable', '=', 'Usuario.idUsuario')
                ->join('TransicionItem', 'TransicionItem.idItem', '=', 'Item.idItem')
                ->where('Usuario.idUsuario', '=', $id)
                ->orderBy('TransicionItem.fechahora', 'Desc');
        }
	}

