<?php

namespace App\Http\Resources\Channels;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'channel_id' => $this->page_id,
            'channel_profile_picture' => $this->page_profile_picture,
            'channel_name' => $this->page_name,
        ];
    }
}
