<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelectionCode extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'selection_codes';

    protected $fillable = [
        'code',
        'value',
        'category'
    ];
}
