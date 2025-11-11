<?php

namespace App\Models;

use CodeIgniter\Model;

class JobApplicationsModel extends Model
{
    protected $table = 'job_applications';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'job_position_id', 
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'resume_url', 
        'cover_letter', 
        'application_status', 
        'source', 
        'ip_address', 
        'privacy_consent'
    ];
    protected $returnType = 'array';
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}