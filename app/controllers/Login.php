<?php

class Login extends Controller
{

    public function index()
    {
        $this->view('templates/header', $data = []);
        $this->view('login/index', $data = []);
        $this->view('templates/footer', $data = []);
    }
}
