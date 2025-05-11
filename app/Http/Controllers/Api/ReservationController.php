<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\Service;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends ApiController
{
    private const ADMIN_METHODS = [
        'index',
        'confirm',
        'reject',
        'done',
    ];


    private ReservationService $reservation_service ;
    public function __construct(ReservationService $reservation_service){
        $this->reservation_service = $reservation_service ;
        $this->middleware('auth:sanctum');
        $this->middleware('IsAdminApi')->only(self::ADMIN_METHODS) ;
    }

    public function index() {
        $reservations = $this->reservation_service->list() ;
        $reservations = ReservationResource::collection( $reservations);
        return $reservations->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }



    public function confirm(Reservation $reservation) {
        $this->reservation_service->confirm($reservation) ;
          $reservation = new ReservationResource( $reservation->refresh());
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function reject(Reservation $reservation) {
        $this->reservation_service->reject($reservation) ;
       $reservation = new ReservationResource( $reservation->refresh());
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }


    public function done(Reservation $reservation) {
        $this->reservation_service->done($reservation) ;
       $reservation = new ReservationResource( $reservation->refresh());
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }
    public function store(ReservationRequest $request ,Service $service)
    {
        $request_validated = $request->validated() ;
        $request_validated['user_id'] = auth('sanctum')->user()->id ;
        $request_validated['service_id'] = $service->id ;
        $reservation = $this->reservation_service->create($request_validated) ;
       $reservation = new ReservationResource( $reservation);
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }

     public function update(ReservationRequest $request ,Reservation $reservation)
    {
        $request_validated = $request->validated() ;
        $this->reservation_service->update($reservation,$request_validated) ;
       $reservation = new ReservationResource( $reservation->refresh());
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }
    public function cancel(Reservation $reservation)
    {
        $this->reservation_service->cancel($reservation);
       $reservation = new ReservationResource( $reservation->refresh());
        return $reservation->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function listForUser()
    {
         $reservations = $this->reservation_service->listForUser(auth('sanctum')->user()->id);
        $reservations = ReservationResource::collection( $reservations);
        return $reservations->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }


}
