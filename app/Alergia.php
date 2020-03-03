<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    //

    protected $filiable=[
		'legajo_id','tipo','observacion'
	];
}
