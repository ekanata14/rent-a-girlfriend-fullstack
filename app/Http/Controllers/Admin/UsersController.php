<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [
            'title' => 'Users',
            'users' => User::all(),
        ];

        return view('admin.users.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Create User',
        ];

        return view('admin.users.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user()->id),
            ],
            'age' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'role' => ['nullable', 'integer'],
            'gender' => ['required', 'integer'],
            'mobile_phone' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        DB::beginTransaction();

        try {
            $user = User::create($validatedData);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create user. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewData = [
            'title' => 'User Details',
            'user' => User::findOrFail($id),
        ];

        return view('admin.users.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viewData = [
            'title' => 'Edit User',
            'user' => User::findOrFail($id),
        ];

        return view('admin.users.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user()->id),
            ],
            'age' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'role' => ['nullable', 'integer'],
            'gender' => ['required', 'integer'],
            'mobile_phone' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->id);
            if ($request->hasFile('profile_picture')) {
                $originalName = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $username = $user->username;
                $date = now()->format('Ymd_His');
                $filename = "{$username}_{$date}.{$extension}";
                $path = $request->file('profile_picture')->storeAs('profile_pictures', $filename, 'public');
                $validatedData['profile_picture'] = $path;
            }

            if ($request->password) {
                $validatedData['password'] = bcrypt($request->password);
            }

            $user->update($validatedData);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update user.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($request->id);
            $user->delete();

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}
