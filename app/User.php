<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    // use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'api_token', 'role_id', 'password', 'multiple_locations',
        'profile_type_id', 'agency_id', 'branch_id', 'print_marketing_version', 'agency',
        'agency2', 'address', 'address_2', 'city', 'state', 'zip', 'phone', 'toll_free_number',
        'member_cst_number', 'website', 'direct_number', 'office_number', 'fax_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
