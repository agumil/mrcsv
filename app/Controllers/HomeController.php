<?php

namespace App\Controllers;

use Ramsey\Uuid\Uuid;

class HomeController extends BaseController
{
    private $uuid;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function index()
    {
        // $this->session->set('uuid', $this->uuid->toString());
        // Set sesi pake UUID
        $_SESSION['uuid'] = $this->uuid->toString();
        return view('home');
    }
}
