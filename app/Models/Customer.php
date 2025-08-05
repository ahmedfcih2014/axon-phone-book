<?php

namespace App\Models;

use App\Traits\PhoneBookComputedAttributes;
use App\Traits\PhoneBookFilterScopes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use PhoneBookComputedAttributes, PhoneBookFilterScopes;

    protected $table = 'customer';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone'
    ];
}
