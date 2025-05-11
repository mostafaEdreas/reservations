<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;

class ServiceController extends ApiController
{
    private ServiceService $service_service ;
    public function __construct(ServiceService $service_service){
        $this->service_service = $service_service ;
        $this->middleware('auth:sanctum');
        $this->middleware('IsAdminApi')->except('index') ;
    }
    public function index()
    {
        $services = $this->service_service->list() ;
        $services = ServiceResource::collection($services);
        return $services->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function active()
    {
        $services = $this->service_service->listActive() ;
        $services = ServiceResource::collection($services);
        return $services->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }


    public function store(ServiceRequest $request)
    {
        $service = $this->service_service->create($request->validated()) ;
        $service = new ServiceResource($service);
        return $service->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function show( Service $service)
    {
        $service = new ServiceResource($service);
        return $service->additional([
            'status' => 200,
            'message' => 'success'
        ]);

    }
    public function update(ServiceRequest $request, Service $service)
    {
        $this->service_service->update($service,$request->validated());
        $service = new ServiceResource($service->refresh());
        return $service->additional([
            'status' => 200,
            'message' => 'success'
        ]);    }

    public function destroy(Service $service)
    {
       $this->service_service->delete($service);
       return $this->successResponse([],'service deleted successfully');
    }


    public function changeStatus (Service $service)
    {
       $this->service_service->toggleStatus($service);
       $service = new ServiceResource($service->refresh());
        return $service->additional([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
