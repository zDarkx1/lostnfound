<?php

class Reports extends Controller
{
    private $reportModel;
    private $userModel;

    public function __construct()
    {
        $this->reportModel = $this->model('Reports_model');
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {


        $data = [
            'title' => 'All Reports',
            'items' => [
                [
                    'title' => 'Black Leather Wallet',
                    'location' => 'Union Square',
                    'date' => 'Sep 15',
                    'description' => 'Slim wallet with metro card.'
                ],
                [
                    'title' => 'iPhone 12',
                    'location' => 'Central Park',
                    'date' => 'Sep 16',
                    'description' => 'Found near the fountain.'
                ],
                [
                    'title' => 'Bicycle',
                    'location' => '5th Avenue',
                    'date' => 'Sep 17',
                    'description' => 'Red mountain bike.'
                ],
                [
                    'title' => 'Black Leather Wallet',
                    'location' => 'Union Square',
                    'date' => 'Sep 15',
                    'description' => 'Slim wallet with metro card.'
                ],
                [
                    'title' => 'iPhone 12',
                    'location' => 'Central Park',
                    'date' => 'Sep 16',
                    'description' => 'Found near the fountain.'
                ],
                [
                    'title' => 'Bicycle',
                    'location' => '5th Avenue',
                    'date' => 'Sep 17',
                    'description' => 'Red mountain bike.'
                ]
            ] //dummy data
        ];

        $this->view('templates/header', $data);
        $this->view('reports/index', $data);
        $this->view('templates/footer', $data);
    }
}
