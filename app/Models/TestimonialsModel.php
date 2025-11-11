<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialsModel extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_name', 'client_position', 'client_company', 'testimonial_text', 'rating', 'image_url', 'is_featured', 'is_approved', 'industry_id'];
    protected $returnType = 'array';
}
