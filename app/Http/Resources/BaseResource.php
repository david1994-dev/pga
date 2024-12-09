<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use App\Constants\ResponseCode;
use Illuminate\Http\Response;

class BaseResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
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
