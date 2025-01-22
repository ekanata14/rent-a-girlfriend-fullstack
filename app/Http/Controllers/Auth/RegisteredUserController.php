<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'age' => ['required', 'integer', 'min:18'],
            'height' => ['required', 'numeric'],
            'gender' => ['required', 'string'],
            'mobile_phone' => ['required', 'string', 'max:15'],
            'profile_picture' => ['nullable', 'image', 'file:jpeg,png,jpg,gif,svg'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        if ($request->hasFile('profile_picture')) {
            $originalName = pathinfo($request->file('profile_picture')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $username = $validatedData['username'];
            $date = now()->format('Ymd_His');
            $filename = "{$username}_{$date}.{$extension}";
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $filename, 'public');
            $validatedData['profile_picture'] = $path;
        }
        $validatedData['role'] = 1;

        $user = User::create($validatedData);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role == 0) {
            return redirect(route('admin.dashboard', absolute: false));
        } else if ($user->role == 1) {
            return redirect(route('client.dashboard', absolute: false));
        }
    }
}
