<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Else_;

class data_req_s2 extends Model
{
    protected $connection= 'mysql2';
    protected $table = 'data_req';
    protected $fillable = ['DR_DATA','DR_ABREV'];
    public $timestamps = false;
    protected $primaryKey = 'DR_CODIGO';

    public function getIdAttribute()
    {
        return $this->DR_CODIGO;
    }


}
