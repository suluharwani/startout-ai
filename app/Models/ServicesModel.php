<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'description', 'icon_class', 'is_active', 'sort_order'];
    protected $returnType = 'array';
}