<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'facilities';

    protected $fillable = [
        'facility_number',
        'facility',
        'address1',
        'address2',
        'city',
        'state',
        'phone1',
        'phone2',
        'fax',
        'web_url'
    ];
}
