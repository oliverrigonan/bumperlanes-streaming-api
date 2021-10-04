<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'providers';

    protected $fillable = [
        'provider_number',
        'npi',
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'qualifications',
        'gender',
        'main_phone',
        'direct_dial',
        'fax',
        'email',
        'web_url',
        'facility_id',
        'profession',
        'speciality1',
        'speciality2',
        'title1',
        'title2',
        'title3',
        'title4',
        'title5',
        'status',
        'date_last_modified',
        'modified_by',
        'image_url',
        'address1',
        'address2',
        'city',
        'state',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
