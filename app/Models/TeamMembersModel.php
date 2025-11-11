<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamMembersModel extends Model
{
    protected $table = 'team_members';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'position', 'bio', 'image_url', 'is_active', 'sort_order'];
    protected $returnType = 'array';
}