<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class PolicyController extends Controller
{
    public function privacy()
    {
        return view('landing.privacy');
    }

    public function terms()
    {
        return view('landing.terms');
    }

    public function refund()
    {
        return view('landing.refund');
    }
}
