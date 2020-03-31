<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use Models\User;

class AuthController
{
    public function login(Request $request){
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post( config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request){
        $validacaoRegras = [
            'username' => [
                'required',
                'max:255',
                'string'
            ],
            'password' => [
                'required',
                'min:6',
                'string'
            ],
            'cirme' => [
                'required',
                Rule::exists('pessoas')->where(function ($query) use ($request) {
                    return $query->where('cirme', $request->cirme)->where('falecido', false);
                })
            ]
        ];

        $request->validate($validacaoRegras);

        return User::create([
            'name' => $request->username,
            'email' => $request->username,
            'cirme' => $request->cirme,
            'password' => Hash::make($request->password),
        ]);
    }

    public function info(Request $request){
        return $request->user();
    }

    public function logout(){
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}
