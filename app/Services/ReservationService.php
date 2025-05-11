<?php
namespace App\Services;

use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Illuminate\Support\Collection;

class ReservationService
{
    public function create(array $data): Reservation
    {

        return Reservation::create($data);
    }

    public function update(Reservation $reservation,array $data)
    {

        return $reservation->update($data);
    }

    public function list()
    {
        return Reservation::latest()->cursorPaginate(100);
    }


    public function confirm(Reservation $reservation): bool
    {
        return  $reservation->update(['status' => Reservation::CONFIRMED['value'] ]);
    }

    public function cancel(Reservation $reservation): bool
    {
        return $reservation->update(['status' => Reservation::CANCELED['value']]);
    }

    public function done(Reservation $reservation): bool
    {
        return $reservation->update(['status' =>Reservation::DONE['value'] ]);
    }

    public function reject(Reservation $reservation): bool
    {
        return $reservation->update(['status' => Reservation::REJECTED['value']]);
    }

    public function listForUser($userId)
    {
        return Reservation::where('user_id', $userId)->latest()->cursorPaginate(100);;
    }



}
