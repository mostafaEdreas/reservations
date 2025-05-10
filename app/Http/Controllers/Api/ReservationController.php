<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\Service;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
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
        return $this->successResponse([],'reservation confirmed successfully');
    }

    public function reject(Reservation $reservation) {
        $this->reservation_service->reject($reservation) ;
        return $this->successResponse([],'reservation rejected successfully');
    }


    public function done(Reservation $reservation) {
        $this->reservation_service->done($reservation) ;
        return $this->successResponse([],'reservation is done');
    }
    public function store(ReservationRequest $request ,Service $service)
    {
        $request_validated = $request->validated() ;
        $request_validated['user_id'] = auth('sanctum')->user()->id ;
        $request_validated['service_id'] = $service->id ;
        $data = $this->reservation_service->create($request_validated) ;
        return $this->successResponse([],'reservation created successfully');
    }

     public function update(ReservationRequest $request ,Reservation $reservation)
    {
        $request_validated = $request->validated() ;
        $data = $this->reservation_service->update($reservation,$request_validated) ;
        return redirect()->to('reservations')->with('success',value: 'your reservation updated successfully');
    }
    public function cancel(Reservation $reservation)
    {
        $this->reservation_service->cancel($reservation);
        return $this->successResponse([],'reservation cancled successfully');
    }

    public function listForAuth()        
    {
        $reservations =  Reservation::where('user_id', auth('sanctum')->user()->id)->latest()->get();
        $reservations = ReservationResource::collection( $reservations);
        return $reservations->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }


}
