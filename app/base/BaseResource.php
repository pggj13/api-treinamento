<?php

namespace App\Base;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource {

    /*public function __construct($resource) {
        $resourceWithRelations = $resource ? $resource->loadRelations() : $resource;
        parent::__construct($resourceWithRelations);
    }*/

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return parent::toArray($request);
    }

}
