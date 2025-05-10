<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    private ServiceService $service_service ;
    public function __construct(ServiceService $service_service){
        $this->service_service = $service_service ;
        $this->middleware('auth') ;
    }
    public function index()  
    {
        $data['services'] = $this->service_service->listActive() ;
        return view('client.services.index',$data);
    }
}
