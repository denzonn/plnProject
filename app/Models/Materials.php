<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'spesification',
        'materials_type_id',
        'new_stock',
        'limit_stock',
        'used_stock',
        'last_placement_date',
        'purchase_link',
        'selected_materials'
    ];

    public function materials_type()
    {
        return $this->belongsTo(MaterialsType::class, 'materials_type_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(MaterialImage::class);
    }
}
