<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StarshipInventory extends Model
{
    protected $primaryKey = 'starship_id';

    public $incrementing = false;

    protected $fillable = ['starship_id', 'count'];
}
