<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegisterRequest $request)
    {
        $fullName = $request->first_name . ' ' . $request->last_name;
        $user = User::create([
            'name'      => $fullName,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $address = "Blk {$request->blk} Lot {$request->lot} Reginaville2000 Brgy. Inocencio, Trece Martires City Cavite";

        $memberInfo = [
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'mobile_number' => $request->mobile_number,
            'birthdate' => $request->birthdate,
            'block' => $request->block,
            'lot' => $request->lot,
            'address' => $address
        ];

        $user->memberInfo()->create($memberInfo);
        Auth::login($user);

        event(new Registered($user));
        return redirect(RouteServiceProvider::HOME);
    }
}
