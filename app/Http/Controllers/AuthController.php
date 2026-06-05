<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'rol' => 'usuario',
]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function googleLogin(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
    ]);

    $user = User::where(
        'email',
        $request->email
    )->first();

    if (!$user) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,

            // contraseña aleatoria
            'password' => bcrypt(
                uniqid()
            ),

            'rol' => 'usuario',
        ]);
    }

    $token = $user
        ->createToken('token-name')
        ->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
}

    public function cambiarPassword(Request $request)
{
    $request->validate([
        'password_actual' => 'required',
        'password_nueva' => 'required|min:8|confirmed',
    ]);

    $user = $request->user();

    if (!Hash::check(
        $request->password_actual,
        $user->password
    )) {

        return response()->json([
            'message' => 'La contraseña actual es incorrecta'
        ], 400);
    }

    $user->password = Hash::make(
        $request->password_nueva
    );

    $user->save();

    return response()->json([
        'message' => 'Contraseña actualizada correctamente'
    ]);
}

public function actualizarPerfil(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $user = $request->user();

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    return response()->json([
        'message' => 'Perfil actualizado',
        'user' => $user
    ]);
}

public function guardarFcmToken(Request $request)
{
    $request->validate([
        'fcm_token' => 'required'
    ]);

    $user = $request->user();

    $user->fcm_token = $request->fcm_token;

    $user->save();

    return response()->json([
        'message' => 'Token guardado'
    ]);
}
}