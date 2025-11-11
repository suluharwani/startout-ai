<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\ServicesModel;
use App\Models\IndustriesModel;
use App\Models\TeamMembersModel;
use App\Models\TestimonialsModel;

class Home extends BaseController
{
    protected $siteSettings;
    protected $services;
    protected $industries;
    protected $teamMembers;
    protected $testimonials;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->services = new ServicesModel();
        $this->industries = new IndustriesModel();
        $this->teamMembers = new TeamMembersModel();
        $this->testimonials = new TestimonialsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Startout AI - Intelligent Customer Experience Solutions',
            'settings' => $this->getSiteSettings(),
            'services' => $this->services->where('is_active', 1)
                                       ->orderBy('sort_order', 'ASC')
                                       ->findAll(6),
            'industries' => $this->industries->where('is_active', 1)
                                           ->orderBy('sort_order', 'ASC')
                                           ->findAll(5),
            'teamMembers' => $this->teamMembers->where('is_active', 1)
                                             ->orderBy('sort_order', 'ASC')
                                             ->findAll(3),
            'testimonials' => $this->testimonials->where('is_approved', 1)
                                               ->where('is_featured', 1)
                                               ->orderBy('created_at', 'DESC')
                                               ->findAll(3)
        ];

        return view('home', $data);
    }

    private function getSiteSettings()
    {
        $settings = $this->siteSettings->findAll();
        $result = [];
        
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $result;
    }
}