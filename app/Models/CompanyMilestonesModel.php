<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyMilestonesModel extends Model
{
    protected $table = 'company_milestones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['year', 'title', 'description', 'icon_class', 'sort_order'];
    protected $returnType = 'array';
}