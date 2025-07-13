<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\User;

use App\Domain\Clients\TelegramWebApp\Http\Resources\Balance\BalanceResource;
use App\Models\BalanceAccount\BalanceAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $telegram_id
 * @property string $login
 * @property BalanceAccount $balance
 */
class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'telegram_id' => $this->telegram_id,
            'login' => $this->login,
            'balance' => new BalanceResource($this->balance)
        ];
    }
}
