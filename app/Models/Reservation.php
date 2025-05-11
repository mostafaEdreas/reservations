<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    use HasFactory;


        // i was need use it in validtion request
    const PENDING   =  ['value' => 0 ,'alis'=>'pending']  ;
    const CONFIRMED =  ['value' => 1 ,'alis'=>'confirmed']  ;
    const DONE =  ['value' => 2 ,'alis'=>'done' ] ;
    const CANCELED = ['value' => 3 ,'alis'=>'cancelled' ] ;
    const REJECTED  =  ['value' => 4 ,'alis'=>'rejected' ]  ;
    protected $fillable = [
        'user_id',
        'service_id',
        'reservation_date',
        'status',
    ];


    public static function statuses(): array
    {
        return [
            self::PENDING,
            self::CONFIRMED,
            self::CANCELED,
            self::DONE,
            self::REJECTED,
        ];
    }

    protected $casts = [
        'reservation_date' => 'datetime',
    ];
    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getStatusTextAttribute()
    {
        $statuses = self::statuses();

        foreach ($statuses as $status) {
            if ($status['value'] == $this->status) {
                return $status['alis'];
            }
        }

        return 'unknown';
    }

}
