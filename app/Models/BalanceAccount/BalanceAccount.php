<?php

namespace App\Models\BalanceAccount;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id Ид
 * @property integer $value Сумма в копейках
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class BalanceAccount extends Model
{
    protected $fillable = [
        'value',
    ];
}
