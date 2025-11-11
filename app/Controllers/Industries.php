<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\IndustriesModel;
use App\Models\ServicesModel;

class Industries extends BaseController
{
    protected $siteSettings;
    protected $industries;
    protected $services;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->industries = new IndustriesModel();
        $this->services = new ServicesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Industries We Serve - Startout AI',
            'settings' => $this->getSiteSettings(),
            'industries' => $this->industries->where('is_active', 1)
                                           ->orderBy('sort_order', 'ASC')
                                           ->findAll(),
            'services' => $this->services->where('is_active', 1)
                                       ->orderBy('sort_order', 'ASC')
                                       ->findAll(6)
        ];

        return view('industries', $data);
    }

    public function show($slug = null)
    {
        $industry = $this->industries->where('slug', $slug)
                                    ->where('is_active', 1)
                                    ->first();

        if (!$industry) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $industry['name'] . ' - Startout AI',
            'settings' => $this->getSiteSettings(),
            'industry' => $industry,
            'services' => $this->services->where('is_active', 1)
                                       ->orderBy('sort_order', 'ASC')
                                       ->findAll()
        ];

        return view('industry_detail', $data);
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