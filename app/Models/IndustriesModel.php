<?php

namespace App\Models;

use CodeIgniter\Model;

class IndustriesModel extends Model
{
    protected $table = 'industries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'description', 'icon_class', 'is_active', 'sort_order'];
    protected $returnType = 'array';
}