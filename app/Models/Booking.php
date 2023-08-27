<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Menu;
use App\Models\Payment;
class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relasi belongto ke tabel users
    public function guest()
    {
        return $this->belongsTo('App\Models\User', 'guest_id', 'id');
    }

    //relasi belongto ke tabel menus
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }

   //Relasi hasOne ke tabel payments
    public function payment()
    {
         return $this->hasOne('App\Models\Payment', 'booking_id', 'id');
    }
}
