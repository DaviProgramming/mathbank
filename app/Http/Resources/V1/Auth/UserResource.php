<?php

namespace App\Http\Resources\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'wallets_limit' => $this->wallets_limit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
