<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderLog extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'provider_logs';

    protected $fillable = [
        'log_date',
        'provider_id',
        'modified_by',
        'modified_field',
        'old_value',
        'new_value'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
