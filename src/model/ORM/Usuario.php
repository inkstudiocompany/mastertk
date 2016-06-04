<?php
	namespace Model\ORM;

	use Illuminate\Database\Eloquent\Collection;

    class Usuario extends EntityBase{
            
		protected $table = "Usuario";
		protected $primaryKey = "idUsuario";

		public function rolPrincipal(){
			return $this->belongsTo('Model\ORM\Rol','idRolPrincipal','idRol');
		}

		public function lidera(){
			return $this->hasMany('Model\ORM\Proyecto','idLider','idUsuario');
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

        public function scopeResponsable($query, $id)
        {
            return $query
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
                ->join('Item', 'Item.responsable', '=', 'UsuarioRolEquipo.idUsuarioRolEquipo')
                ->where('Usuario.idUsuario', '=', $id);
        }

        public function scopeHistory($query, $id)
        {
            return $query
                ->join('TransicionItem', 'TransicionItem.idUsuario', '=', 'Usuario.idUsuario')
                ->join('Item', 'TransicionItem.idItem', '=', 'Item.idItem')
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuarioRolEquipo', '=', 'Item.responsable')
                ->where('Usuario.idUsuario', '=', $id)
                ->orderBy('TransicionItem.fechahora', 'Desc');
        }

        public function scopeProyectos($query, $id)
        {
            return $query
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
                ->join('Equipo', 'Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
                ->join('Proyecto', 'Proyecto.idProyecto', '=', 'Equipo.idProyecto')
                ->select('Proyecto.*')
                ->where('UsuarioRolEquipo.idUsuario', '=', $id);
        }

        public function isResponsable()
        {
            /** @var Collection $test */
            $responsable = $this->responsable($this->idUsuario)->get();
            return !$responsable->isEmpty();
        }

        public function getProyectos()
        {
            $lider = $this->lidera();
            return $this->proyectos($this->idUsuario)->union($lider)->get();
        }
	}

