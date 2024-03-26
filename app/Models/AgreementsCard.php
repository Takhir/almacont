<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementsCard extends Model
{
    use SoftDeletes, HasFactory;

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class, 'counterparty_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
