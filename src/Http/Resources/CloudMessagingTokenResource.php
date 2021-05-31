<?php

namespace BaltTechnologies\LaravelFirebaseCloudMessaging\Http\Resources;

use BaltTechnologies\LaravelFirebaseCloudMessaging\Models\CloudMessagingToken;
use Illuminate\Http\Resources\Json\JsonResource;

class CloudMessagingTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var CloudMessagingToken $cloudMessagingToken */

        $cloudMessagingToken = $this->resource;

        return [
            'id' => $cloudMessagingToken->id,
            'token' => $cloudMessagingToken->token,
            'user_id' => $cloudMessagingToken->user_id,
        ];
    }
}
