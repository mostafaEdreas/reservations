<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'user_id' => $this->user_id ,
            'user_name' => $this->user?->name ,
            'service_id' => $this->service_id ,
            'service_name' => $this->service?->name ,
            'date' => date_format($this->reservation_date , 'Y-m-d') ,
            'time' => date_format($this->reservation_date , 'H:i:s') ,
            'dateTime' => date_format($this->reservation_date , 'Y-m-d H:i:s') ,
            'status' => $this->status ,
            'status_text' => $this->status_text ,
        ];
    }
}
