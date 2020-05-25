<?php

class Cron extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $file = 'cron.txt';
        $current = 'This is Cron Job';

        file_put_contents($file, $current);
    }
}