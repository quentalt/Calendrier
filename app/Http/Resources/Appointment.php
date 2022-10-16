<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use JsonSerializable;

class Appointment extends JsonResource
{
    private mixed $begin;
    private mixed $end;
    private mixed $reason;
    private mixed $session;
    private mixed $color;
    private mixed $user_id;
    private mixed $textColor;
    private mixed $user;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => strtoupper($this->reason),
            'start' => $this->begin,
            'end' => $this->end,
            'session' => $this->session,
            'color' => $this->color,
            'textColor' => $this->textColor,
            'user_id' => $this->user_id,
            $this->mergeWhen(Auth::user()->getAuthIdentifierName(), [
                'name' => $this->user->name,
                'email' => $this->user->email,             ''
            ])
            ];
    }

}
