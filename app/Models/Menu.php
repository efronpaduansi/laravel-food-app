<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'thumbnail',
        'name',
        'category',
        'stock',
        'price',
    ];

    public function payment(){
        return $this->hasMany(Payment::class, 'menu_id', 'id');
    }
}
