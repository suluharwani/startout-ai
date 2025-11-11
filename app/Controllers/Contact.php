<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\TeamMembersModel;
use App\Models\ContactInquiriesModel;

class Contact extends BaseController
{
    protected $siteSettings;
    protected $teamMembers;
    protected $contactInquiries;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->teamMembers = new TeamMembersModel();
        $this->contactInquiries = new ContactInquiriesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Contact Startout AI | Intelligent Customer Experience Solutions',
            'settings' => $this->getSiteSettings(),
            'teamMembers' => $this->teamMembers->where('is_active', 1)
                                             ->orderBy('sort_order', 'ASC')
                                             ->findAll(3)
        ];

        return view('contact', $data);
    }

    public function submit()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            
            $validation->setRules([
                'first_name' => 'required|min_length[2]|max_length[100]',
                'last_name'  => 'required|min_length[2]|max_length[100]',
                'email'      => 'required|valid_email',
                'company'    => 'permit_empty|max_length[255]',
                'phone'      => 'permit_empty|max_length[20]',
                'service_interest' => 'required',
                'message'    => 'required|min_length[10]',
                'privacy_consent' => 'required'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $data = [
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name'  => $this->request->getPost('last_name'),
                    'email'      => $this->request->getPost('email'),
                    'company'    => $this->request->getPost('company'),
                    'phone'      => $this->request->getPost('phone'),
                    'service_interest' => $this->request->getPost('service_interest'),
                    'message'    => $this->request->getPost('message'),
                    'privacy_consent' => 1,
                    'ip_address' => $this->request->getIPAddress(),
                    'inquiry_status' => 'new'
                ];

                if ($this->contactInquiries->save($data)) {
                    return redirect()->to('/contact/success');
                } else {
                    return redirect()->back()->with('error', 'Failed to submit your inquiry. Please try again.');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }

        return redirect()->to('/contact');
    }

    public function success()
    {
        $data = [
            'title' => 'Message Sent - Startout AI',
            'settings' => $this->getSiteSettings()
        ];

        return view('contact_success', $data);
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