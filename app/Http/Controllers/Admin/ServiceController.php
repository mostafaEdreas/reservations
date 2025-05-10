<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private ServiceService $service_service ;
    public function __construct(ServiceService $service_service){
        $this->service_service = $service_service ;
        $this->middleware('IsAdmin') ;
    }
    public function index()  
    {
        $data['services'] = $this->service_service->list() ;
        return view('admin.services.index',$data);
    }

    public function create()  
    { 
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request)  
    {
        $this->service_service->create($request->validated());
        return redirect()->route('admin.services.index')->with('success','Services added successfully');
    }

    public function edit( Service $service)  
    {
        $data['service'] = $service ;
        return view('admin.services.edit',$data);
    }
    public function update(ServiceRequest $request, Service $service)  
    {
        $this->service_service->update($service,$request->validated());
        return redirect()->route('admin.services.index')->with('success','Services updated successfully');
    }

    public function destroy(Service $service)  
    {
       $this->service_service->delete($service);
       return redirect()->route('admin.services.index')->with('success','Services deleted successfully');
    }

    public function changeStatus (Service $service)  
    {
       $this->service_service->toggleStatus($service);
       return redirect()->route('admin.services.index')->with('success','Services deleted successfully');
    }
}

