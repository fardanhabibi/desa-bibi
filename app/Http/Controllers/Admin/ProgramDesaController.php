<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * DEPRECATED: ProgramDesaController
 * The Program Desa module has been removed from the admin menu and routes.
 * This controller is retained as an archival placeholder and will redirect
 * any incoming requests to the Kegiatan index to avoid breaking links.
 */
class ProgramDesaController extends Controller
{
    public function __call($method, $parameters)
    {
        // Redirect any action to kegiatan index to avoid 404s
        return redirect()->route('admin.kegiatan.index');
    }

    // Keep a simple route for direct index access as well
    public function index()
    {
        return redirect()->route('admin.kegiatan.index');
    }
}
