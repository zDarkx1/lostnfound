<?php

class LandingPage extends Controller
{
    public function index()
    {
        //dummy data to be rendered
        $data = [
            'title' => 'Lost and Found',
            'description' => 'A platform to report lost and found items.',
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
            ]
        ];
        $this->view('templates/header', $data);
        $this->view('landingpage/index', $data);
        $this->view('templates/footer', $data);
    }
}
