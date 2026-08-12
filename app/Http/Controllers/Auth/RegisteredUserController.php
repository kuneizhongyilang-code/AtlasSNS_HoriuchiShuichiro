<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        $request->validate([
            'username' => [ 'required', 'string', 'min:2', 'max:12', ],
            'email' => [ 'required', 'string', 'min:5', 'max:40', 'email', 'unique:users,email', ],
            'password' => [ 'required', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', ],
            'password_confirmation' => [ 'required', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', 'same:password', ], ]);//^[a-zA-Z0-9]+$/「1文字以上の半角英数字だけで構成されている文字列」に完全に一致することを表す

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('added')->with('username', $request->username);
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
