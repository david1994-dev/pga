<?php

namespace App\Http\Resources;

use App\Constants\ResponseCode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;

class BaseResourceCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.    
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with(Request $request)
    {
        return [
            'status_code' => ResponseCode::SUCCESS,
            "message" => Arr::get(ResponseCode::MESSAGE, Response::HTTP_OK, null)
        ];
    }
}
