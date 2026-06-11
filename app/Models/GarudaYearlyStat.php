<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GarudaYearlyStat extends Model
{
    protected $table = 'sinta_garuda_yearly_stats';
    protected $guarded = [];

    public function detailDosen(): BelongsTo
    {
        return $this->belongsTo(DetailDosen::class, 'sinta_id', 'sinta_id');
    }
}
