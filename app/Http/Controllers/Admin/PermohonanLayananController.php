<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * DEPRECATED: PermohonanLayananController
 * The Permohonan Layanan module has been removed from the admin menu and routes.
 * This controller is retained as an archival placeholder and will redirect
 * any incoming requests to the Kegiatan index to avoid breaking links.
 */
class PermohonanLayananController extends Controller
{
    public function __call($method, $parameters)
    {
        return redirect()->route('admin.kegiatan.index');
    }

    public function index()
    {
        return redirect()->route('admin.kegiatan.index');
    }
}
