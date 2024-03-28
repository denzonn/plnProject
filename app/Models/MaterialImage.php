<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'materials_id'
    ];

    public function materials()
    {
        return $this->belongsTo(Materials::class, 'materials_id', 'id');
    }
}
