<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->dbFunc = $this->model('DbModel');
    }

    public function error()
    {
        $data = [
            'title' => 'ERROR 404 | YMC',
        ];

        $this->view('pages/404', $data);
    }

    public function contactus()
    {
        $data = [
            'title' => 'Contact Us | YMC',
        ];

        $this->view('pages/contact-us', $data);
    }
}