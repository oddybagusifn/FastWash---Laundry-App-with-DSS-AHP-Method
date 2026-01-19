<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class RawMaterial extends Model
{
protected $table = 'raw_materials';


protected $fillable = [
'item_name',
'item_category',
'stock',
'price'
];
}
