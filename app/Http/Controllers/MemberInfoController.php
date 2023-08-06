<?php

namespace App\Http\Controllers;

use App\Models\MemberInfo;
use App\Http\Requests\StoreMemberInfoRequest;
use App\Http\Requests\UpdateMemberInfoRequest;

class MemberInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberInfo $memberInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberInfo $memberInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberInfoRequest $request, MemberInfo $memberInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberInfo $memberInfo)
    {
        //
    }
}
