<?php

namespace Woodoocoder\LaravelHelpers\Api\Response;

use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Woodoocoder\LaravelHelpers\Api\Response\ApiStatus;
use Woodoocoder\LaravelHelpers\Api\Resource\ApiResourceTrait;

class ApiMessage extends JsonResource {

    use ApiResourceTrait;

    /**
     * @param string $status
     */
    public function __construct(string $status = ApiStatus::SUCCESS) {
        parent::__construct(null);

        $this->status = $status;
    }
}
