<?php

namespace App\Models;

use CodeIgniter\Model;

class JobPositionsModel extends Model
{
    protected $table = 'job_positions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'department', 'location', 'employment_type', 'description', 'requirements', 'responsibilities', 'is_remote', 'is_active', 'application_count'];
    protected $returnType = 'array';
}