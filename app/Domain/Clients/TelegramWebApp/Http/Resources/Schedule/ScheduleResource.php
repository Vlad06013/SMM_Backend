<?php

namespace App\Domain\Clients\TelegramWebApp\Http\Resources\Schedule;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property integer $id Ид
 * @property Carbon $send_planed_date Запланированное время
 */
class ScheduleResource extends JsonResource
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
            'send_planed_date' => $this->send_planed_date->toDateTimeString(),
        ];
    }
}
