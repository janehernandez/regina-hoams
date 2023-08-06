<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminListController extends Controller
{
    public function __invoke()
    {
        $admins = User::whereRole(1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);;
        return Inertia::render('Admin/Admins/Index', compact('admins'));
    }
}
