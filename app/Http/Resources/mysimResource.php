<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class mysimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'sub_date'=>$this->date,
            'end_date'=>$this->end_date,
            'serial'=>$this->sim->serial,
            'period'=>$this->sim->period,
            'price'=>round($this->sim->price),


        ];
    }
}
