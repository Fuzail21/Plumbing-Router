<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPortalController extends Controller
{
    // Public Home
    public function home(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->home($request);
    }

    // Public Data View
    public function data_view(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->data_view($request);
    }

    // Public Search
    public function search(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->search($request);
    }

    // Public SFH ENG
    public function sfh_eng(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->sfh_eng($request);
    }

    // Public COM ENG
    public function com_eng(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->com_eng($request);
    }

    // Public SFH ENG Search
    public function sfh_eng_search(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->sfh_eng_search($request);
    }

    // Public SFH Sort/Filter
    public function sf_sort_filter(Request $request)
    {
        return app(\App\Http\Controllers\JobInformations::class)->sf_sort_filter($request);
    }
}
