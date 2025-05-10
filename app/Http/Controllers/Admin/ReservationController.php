<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private ReservationService $reservation_service ;
    public function __construct(ReservationService $reservation_service){
        $this->reservation_service = $reservation_service ;
        $this->middleware('IsAdmin') ;
    }

    public function index() {
        $data['reservations'] = $this->reservation_service->list() ;
        return view('admin.reservations.index',$data) ;
    }



    public function confirm(Reservation $reservation) {
        $this->reservation_service->confirm($reservation) ;
        return redirect()->back()->with('success',value: 'your reservation confirmed');

    }

    public function reject(Reservation $reservation) {
        $this->reservation_service->reject($reservation) ;
        return redirect()->back()->with('success',value: 'your reservation rejected ');

    }


    public function done(Reservation $reservation) {
        $this->reservation_service->done($reservation) ;
        return redirect()->back()->with('success',value: 'your reservation is done');

    }
}
