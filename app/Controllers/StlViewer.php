<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class StlViewer extends Controller
{
    public function index()
    {
        return view('upload_view');
    }
}
