<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\User;
use App\Models\Booking;
class Payment extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['guest_id', 'menu_id', 'booking_id', 'amount', 'method', 'status'];

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function guest(){
        return $this->belongsTo(User::class, 'guest_id', 'id');
    }
}
