<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Estudio extends JsonResource
{
    public function toArray($request)
    {
        return [
            'imagen' => $this->imagen,
        ];
    }
}
