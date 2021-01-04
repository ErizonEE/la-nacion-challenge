<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleInventory extends Model
{
    protected $primaryKey = 'vehicle_id';

    protected $fillable = ['vehicle_id', 'count'];
}
