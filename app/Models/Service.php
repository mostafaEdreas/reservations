<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'status',
    ];

    const ROLE_ENUM = ['admin', 'editor', 'viewer']; 

    public function reservaions(){
        return $this->hasMany(Reservation::class) ;
    }
    public function scopeActive($q){
       return $q-> where('status', 1) ;
    }

    public function getStatusTextAttribute($q){
        return $this->status ? 'Active' : 'Unactive' ;
    }

    public function getReservationCountAttribute($q){
        return $this->reservaions->count() ;
    }


}
