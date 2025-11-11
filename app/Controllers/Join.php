<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use App\Models\JobPositionsModel;
use App\Models\JobApplicationsModel;

class Join extends BaseController
{
    protected $siteSettings;
    protected $jobPositions;
    protected $jobApplications;

    public function __construct()
    {
        $this->siteSettings = new SiteSettingsModel();
        $this->jobPositions = new JobPositionsModel();
        $this->jobApplications = new JobApplicationsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Join Startout AI | Be Part of the Customer Experience Revolution',
            'settings' => $this->getSiteSettings(),
            'jobPositions' => $this->jobPositions->where('is_active', 1)
                                               ->orderBy('created_at', 'DESC')
                                               ->findAll(6)
        ];

        return view('join', $data);
    }

    public function submit()
    {
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            
            $validation->setRules([
                'first_name' => 'required|min_length[2]|max_length[100]',
                'last_name'  => 'required|min_length[2]|max_length[100]',
                'email'      => 'required|valid_email',
                'phone'      => 'permit_empty|max_length[20]',
                'position'   => 'required',
                'resume'     => 'uploaded[resume]|max_size[resume,5120]|mime_in[resume,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'cover_letter' => 'permit_empty',
                'privacy_consent' => 'required'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Handle file upload
                $resumeFile = $this->request->getFile('resume');
                $resumeFileName = null;

                if ($resumeFile->isValid() && !$resumeFile->hasMoved()) {
                    $resumeFileName = $resumeFile->getRandomName();
                    $resumeFile->move(WRITEPATH . 'uploads/resumes', $resumeFileName);
                }

                $data = [
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name'  => $this->request->getPost('last_name'),
                    'email'      => $this->request->getPost('email'),
                    'phone'      => $this->request->getPost('phone'),
                    'position'   => $this->request->getPost('position'),
                    'resume_url' => $resumeFileName,
                    'cover_letter' => $this->request->getPost('cover_letter'),
                    'privacy_consent' => 1,
                    'ip_address' => $this->request->getIPAddress(),
                    'application_status' => 'submitted',
                    'source' => 'website'
                ];

                // Jika position adalah "other", gunakan nilai dari other_position
                if ($data['position'] === 'other') {
                    $data['position'] = $this->request->getPost('other_position') ?? 'Other Position';
                }

                if ($this->jobApplications->save($data)) {
                    return redirect()->to('/join/success');
                } else {
                    return redirect()->back()->with('error', 'Failed to submit your application. Please try again.');
                }
            } else {
                return redirect()->back()->with('errors', $validation->getErrors());
            }
        }

        return redirect()->to('/join');
    }

    public function success()
    {
        $data = [
            'title' => 'Application Submitted - Startout AI',
            'settings' => $this->getSiteSettings()
        ];

        return view('join_success', $data);
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