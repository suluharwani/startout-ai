<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\JobPositionsModel;

class Careers extends BaseController
{
    protected $siteSettings;
    protected $jobPositions;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->jobPositions = new JobPositionsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Careers at Startout AI - Join Our Team',
            'settings' => $this->getSiteSettings(),
            'jobPositions' => $this->jobPositions->where('is_active', 1)
                                               ->orderBy('created_at', 'DESC')
                                               ->findAll()
        ];

        return view('careers', $data);
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