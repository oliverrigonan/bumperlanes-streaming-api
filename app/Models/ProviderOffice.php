<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderOffice extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'provider_offices';

    protected $fillable = [
        'provider_id',
        'office',
        'office_contact',
        'address1',
        'address2',
        'city',
        'state',
        'phone1',
        'phone2',
        'fax',
        'web_url'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
