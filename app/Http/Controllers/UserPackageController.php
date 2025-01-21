<?php

namespace App\Http\Controllers;

use App\Models\UserPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'User Packages',
            'userPackages' => UserPackage::all(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Create User Package',
        ];

        return view('admin.user-packages.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'available' => ['required', 'boolean'],
        ]);

        DB::beginTransaction();

        try {
            UserPackage::create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create user package');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewData = [
            'title' => 'User Package',
            'userPackage' => UserPackage::findOrFail($id),
        ];

        return view('admin.user-packages.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viewData = [
            'title' => 'Edit User Package',
            'userPackage' => UserPackage::findOrFail($id),
        ];

        return view('admin.user-packages.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'available' => ['required', 'boolean'],
        ]);

        DB::beginTransaction();

        try {
            $userPackage = UserPackage::findOrFail($request->id);
            $userPackage->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update user package');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            UserPackage::findOrFail($request->id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to delete user package');
        }
    }
}
