<?php

namespace App\Models\BalanceAccount;

use Illuminate\Database\Eloquent\Model;


/**
 * @property integer $id Ид
 * @property integer $balance_id Ид баланса
 * @property integer $value Сумма в копейках
 * @property integer  $operation_type Тип операции(write_on - пополнение,write_off - списание)
 * @property string $created_at Дата время создания
 * @property string $updated_at Дата время обновления
 */
class BalanceAccountHistory extends Model
{
    protected $fillable = [
        'balance_id',
        'value',
        'operation_type',
    ];


}
