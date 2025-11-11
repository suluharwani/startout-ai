<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactInquiriesModel extends Model
{
    protected $table = 'contact_inquiries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone', 'company', 'service_interest', 'message', 'inquiry_status', 'assigned_to', 'privacy_consent', 'ip_address'];
    protected $returnType = 'array';
}