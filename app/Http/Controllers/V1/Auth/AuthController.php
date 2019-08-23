<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use function auth;
use function config;
use function request;
use function response;

/**
 * @resource Auth
 */
class AuthController extends Controller {

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login() {
        //Autenticação via e-mail
        $credentialsEmail = request(['email', 'password']);

        //Autenticação via usuario
        $credentialsUser = request(['user', 'password']);

        $tokenMail = auth()->attempt($credentialsEmail);

        //Tenta autenticar das duas formas
        if ($tokenMail) {
            return $this->respondWithToken($tokenMail);
        } else {
            $tokenUser = auth()->attempt($credentialsUser);
            if ($tokenUser) {
                return $this->respondWithToken($tokenUser);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Valida o token e retorna o usuário caso seja válido
     * @return JsonResponse
     */
    public function validateJwt() {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout() {
        auth()->logout(true);
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token) {

        $user = auth()->user();

        return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => config("jwt.ttl") * 60,
                    'user' => $user
        ]);
    }

}
