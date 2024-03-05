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
    //generate docs for scribe using transformers and request classes

    /**
     * @group Auth
     * 
     * Register a user
     * 
     * @bodyParam name string required The name of the user
     * @bodyParam email string required The email of the user
     * @bodyParam password string required The password of the user
     * @bodyParam password_confirmation string required The password confirmation of the user
     * 
     * @response 201 
     * "data": {
     * "id": 1,
     * "name": "John Doe",
     * "email": "example@mail.com"
     * "created_at": "2021-08-12 12:00:00",
     * "updated_at": "2021-08-12 12:00:00"
     * }
     * 
     * 
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "name": ["The name field is required."],
     * "email": ["The email field is required."],
     * "password": ["The password field is required."]
     * }
     * 
     * 
     * @response 401 {
     * 
     * "message": "Invalid login details"
     * }
     * 
     */
   
    
    
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

    // login method use the transformer

    /**
     * @group Auth
     * 
     * Login a user
     * 
     * @bodyParam email string required The email of the user
     * @bodyParam password string required The password of the user
     * 
     * @response 201 {
     * "data": {
     * "id": 1,
     * "name": "John Doe",
     * "email": "jon@example.com"
     * "created_at": "2021-08-12 12:00:00",
     * "updated_at": "2021-08-12 12:00:00"
     * }
     * }
     * 
     * @response 401 {
     * 
     * "message": "Invalid login details"
     * }
     * 
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": ["The email field is required."],
     * "password": ["The password field is required."]
     * }
     * }
     * 
     */


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

    /**
     * @group Auth
     * 
     * Logout a user
     * 
     * @response 200 {
     * "message": "Logged out successfully"
     * }
     * 
     */

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    //  forgot password method

    /**
     * @group Auth
     * 
     * Forgot password
     * 
     * @bodyParam email string required The email of the user
     * 
     * @response 200 {
     * "message": "Password reset link sent to your email"
     * }
     * 
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": ["The email field is required."]
     * }
     * }
     * 
     * @response 404 {
     * "message": "We can't find a user with that e-mail address."
     * }
     * 
     */

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

    /**
     * @group Auth
     * 
     * Reset password
     * 
     * @bodyParam email string required The email of the user
     * @bodyParam token string required The token of the user
     * @bodyParam password string required The password of the user
     * @bodyParam password_confirmation string required The password confirmation of the user
     * 
     * @response 200 {
     * "message": "Password has been successfully changed"
     * }
     * 
     * @response 400 {
     * "message": "Invalid token provided"
     * }
     * 
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "email": ["The email field is required."],
     * "token": ["The token field is required."],
     * "password": ["The password field is required."]
     * }
     * }
     * 
     */
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
