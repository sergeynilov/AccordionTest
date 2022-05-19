<?php

namespace App\Http\Controllers;

use App\Http\Resources\CMSItemResource;
use App\Models\CMSItem;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use DB;

class AccordionPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('AccordionPage/Index', [ ]);
    }

    public function load_active_cms_items()
    {

        $cMSItems = CMSItem
            ::getByPublished(true)
            ->with('author')
            ->orderBy('title', 'asc')
            ->get();
        return (CMSItemResource::customCollection($cMSItems, true));
    } // public function load_active_cms_items()


}

