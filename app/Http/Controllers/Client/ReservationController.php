<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private ReservationService $reservation_service ;
    public function __construct(ReservationService $reservation_service){
        $this->reservation_service = $reservation_service ;
        $this->middleware('auth') ;
    }

    public function create(Service $service)
    {
        $data['service'] = $service ;
        return view('client.reservations.create',$data);
    }
    public function store(ReservationRequest $request ,Service $service)
    {
        $request_validated = $request->validated() ;
        $request_validated['user_id'] = auth()->user()->id ;
        $request_validated['service_id'] = $service->id ;
        $data = $this->reservation_service->create($request_validated) ;
        return redirect()->to('reservations')->with('success',value: 'your reservation created successfully');
    }

    public function edit(Reservation $reservation)
    {
        $data['reservation'] = $reservation ;
        return view('client.reservations.edit',$data);
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
        return redirect()->back()->with('success',value: 'your reservation cancled successfully');
    }

    public function index()        
    {
        $data['reservations'] =  Reservation::where('user_id', auth()->user()->id)->latest()->get();
        return view('client.reservations.index',$data);
    }
}
