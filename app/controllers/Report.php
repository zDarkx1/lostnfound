<?php

class Report extends Controller
{
    private $ReportModel;
    private $userModel;

    public function __construct()
    {
        $this->ReportModel = $this->model('Report_model');
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        $data = [
            'title' => 'Make a report Reports',

        ];

        $this->view('templates/header', $data);
        $this->view('report/index', $data);
        $this->view('templates/footer', $data);
    }
}
