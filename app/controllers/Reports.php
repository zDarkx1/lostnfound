<?php

class Reports extends Controller
{

    
    public function index()
    {
        $this->view('templates/header', $data = []);
        $this->view('reports/index', $data = []);
        $this->view('templates/footer', $data = []);
    }

    public function details()
    {
        $this->view('templates/header', $data = []);
        $this->view('reports/details', $data = []);
        $this->view('templates/footer', $data = []);
    }
}
