<?php

namespace Model\ORM;
use Illuminate\Database\Eloquent\Model  as Model;

abstract class EntityBase extends Model {

    protected $table = '';
    public $timestamps = false;

}
