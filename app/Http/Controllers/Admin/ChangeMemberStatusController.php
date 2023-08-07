<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateChangeMemberStatusRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ChangeMemberStatusController extends Controller
{
    public function __invoke(UpdateChangeMemberStatusRequest $request, User $user)
    {
        $user->memberInfo()->update($request->validated());
        return redirect()->route('admin.homeowners')->with('message', 'success|member status changed');
    }
}
