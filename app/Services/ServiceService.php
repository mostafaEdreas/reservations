<?php
namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data): bool
    {
        return $service->update($data);
    }

    public function toggleStatus(Service $service): bool
    {
        return $service->update(['status' => !$service->status]);
    }

    public function setAdmin(Service $service): bool
    {
        return $service->update(['role' => 'admin']);
    }
    public function setUser(Service $service): bool
    {
        return $service->update(['role' => 'user']);
    }
    public function listActive()
    {
        return Service::active()->cursorPaginate(100);
    }
    public function list()
    {
        return Service::cursorPaginate(100);
    }

    public function delete(Service $service)
    {
        return $service->delete();
    }
}
