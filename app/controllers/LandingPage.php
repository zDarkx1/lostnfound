<?php

class LandingPage extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Lost and Found',
            'description' => 'A platform to report lost and found items.'
        ];
        $this->view('templates/header', $data);
        $this->view('landingpage/index', $data);
        $this->view('templates/footer', $data);
    }
}
