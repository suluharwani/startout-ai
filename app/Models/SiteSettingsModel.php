<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingsModel extends Model
{
    protected $table = 'site_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['setting_key', 'setting_value', 'setting_type', 'description'];
    protected $returnType = 'array';
}