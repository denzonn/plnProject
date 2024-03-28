<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialsType extends Model
{
    use HasFactory;

    protected $table = 'materials_type'; 

    protected $fillable = [
        'name'
    ];
}
