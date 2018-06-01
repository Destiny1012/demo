<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Catalog;
use App\Http\Resources\CatalogResource;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = new CatalogResource(Catalog::pluck('catalog'));
        return $catalogs;
    }
}
