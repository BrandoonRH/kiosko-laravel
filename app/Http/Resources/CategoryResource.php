<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Control total sobre lo que vamos a returnar en las respuestas 
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            //'nombre_id' => $this->id . " - " . $this->nombre
            'icono' => $this->icono
        ]; 
    }
}
