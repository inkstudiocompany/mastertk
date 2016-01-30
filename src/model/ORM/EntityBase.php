<?php

namespace Model\ORM;
use Illuminate\Database\Eloquent\Model  as Model;

abstract class EntityBase extends Model {
    //put your code here
    protected $table = '';
    public $timestamps = false;

}
