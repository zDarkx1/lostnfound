<?php

class Register extends Controller
{
    public function index()
    {
        $this->view('templates/header', $data = []);
        $this->view('register/index', $data = []);
        $this->view('templates/footer', $data = []);
    }
}
