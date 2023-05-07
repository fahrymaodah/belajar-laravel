<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteModel extends Model
{
    use HasFactory;

    public $timestamps      = false;

    protected $table        = 'waste';
    protected $primaryKey   = 'waste_id';
    protected $fillable     = ['category_id', 'waste_name'];
}
