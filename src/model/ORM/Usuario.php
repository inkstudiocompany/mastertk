<?php
	namespace Model\ORM;

	class Usuario extends EntityBase{
            
		protected $table = "Usuario";
		protected $primaryKey = "idUsuario";


		/*public function tipoDocumento(){
			return $this->belongsTo('Model\ORM\TipoDocumento','idTipoDocumento','idTipoDocumento');
		}*/

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

		public function scopeAuth($query, $email, $password)
		{
            return $query->whereRaw(
                '(email = \'' . $email . '\' OR usuario = \'' . $email . '\') AND password = \'' . $password . '\''
            );
		}
	}

