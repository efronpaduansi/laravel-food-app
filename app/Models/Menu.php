<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\MenuCategory;
class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'category_id',
        'thumbnail',
        'name',
        'stock',
        'price',
    ];

    public function payment(){
        return $this->hasMany(Payment::class, 'menu_id', 'id');
    }

    public function category(){
        return $this->belongsTo(MenuCategory::class, 'category_id', 'id');
    }
}
