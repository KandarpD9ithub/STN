<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AgentDetails extends Model
{
    protected $fillable = ['user_id', 'agent_name', 'company_name', 'address_1', 'address_2', 'url', 'city', 'state', 'zipcode', 'cst', 'direct_number', 'office_number', 'fax_number', 'magazine_profile'];
}
