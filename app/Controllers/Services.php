<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\ServicesModel;

class Services extends BaseController
{
    protected $siteSettings;
    protected $services;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->services = new ServicesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Our Services - Startout AI',
            'settings' => $this->getSiteSettings(),
            'services' => $this->services->where('is_active', 1)
                                       ->orderBy('sort_order', 'ASC')
                                       ->findAll(),
            'allServices' => $this->services->where('is_active', 1)
                                          ->orderBy('sort_order', 'ASC')
                                          ->findAll()
        ];

        return view('services', $data);
    }

    public function show($slug = null)
    {
        $service = $this->services->where('slug', $slug)
                                 ->where('is_active', 1)
                                 ->first();

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $service['name'] . ' - Startout AI',
            'settings' => $this->getSiteSettings(),
            'service' => $service,
            'relatedServices' => $this->services->where('is_active', 1)
                                              ->where('slug !=', $slug)
                                              ->orderBy('sort_order', 'ASC')
                                              ->findAll(3)
        ];

        // Load view berdasarkan slug service
        $viewName = 'service_' . str_replace('-', '_', $slug);
        if (!view_exists($viewName)) {
            $viewName = 'service_detail';
        }

        return view($viewName, $data);
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