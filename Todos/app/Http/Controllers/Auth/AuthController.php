<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // register method
    public function register(SignupRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $userData  = fractal($user, new UserTransformer());

        return response()->json($userData, 201)->header('Authorization', "Bearer $token",)
            ->header("Access-Control-Expose-Headers", "Authorization");
    }

    // login method

    public function login(LoginRequest $request)
    {
        $request->validated();
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $userData  = fractal($user, new UserTransformer());

        return response()->json($userData, 201)->header('Authorization', "Bearer $token",)
            ->header("Access-Control-Expose-Headers", "Authorization");
    }

    // logout method

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    //  forgot password method

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        Password::sendResetLink($request->only('email'));

        return response()->json([
            'message' => 'Password reset link sent to your email'
        ]);
    }

    // reset password method
    public function resetPassword(ResetPasswordRequest $request)
    {

        $validatedData = $request->validated();

        if (!User::validPasswordResetToken($validatedData['email'], $validatedData['token'])) {
            return response()->json([
                "message" => "Invalid token provided"
            ], 400);
        }
        $reset_password_status = Password::reset(
            $validatedData,
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json([
                "message" => "Invalid token provided"
            ], 400);
        }
        return response()->json([
            "message" => "Password has been successfully changed"
        ], 200);
    }
}
        // validate the request
