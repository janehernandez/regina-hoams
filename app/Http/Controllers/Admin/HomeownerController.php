<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class HomeownerController extends Controller
{
    public function __invoke()
    {
        $homeowners = User::whereRole(0)->with([
            'memberInfo'
        ])->orderBy('id')
            ->paginate(10);
        return Inertia::render('Admin/Homeowners/Index', compact('homeowners'));
    }
}
