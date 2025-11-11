<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\TeamMembersModel;
use App\Models\CompanyMilestonesModel;

class About extends BaseController
{
    protected $siteSettings;
    protected $teamMembers;
    protected $milestones;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->teamMembers = new TeamMembersModel();
        $this->milestones = new CompanyMilestonesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'About Startout AI - Intelligent Customer Experience Solutions',
            'settings' => $this->getSiteSettings(),
            'teamMembers' => $this->teamMembers->where('is_active', 1)
                                             ->orderBy('sort_order', 'ASC')
                                             ->findAll(),
            'milestones' => $this->milestones->orderBy('year', 'ASC')
                                           ->orderBy('sort_order', 'ASC')
                                           ->findAll()
        ];

        return view('about', $data);
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