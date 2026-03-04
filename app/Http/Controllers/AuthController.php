<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Đăng ký tài khoản mới.
     * POST /api/auth/register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role_id'  => 1, // Mặc định: khách hàng
        ]);

        $token = auth('api')->login($user);

        return $this->respondWithToken($token, 201);
    }

    /**
     * Đăng nhập — trả về access_token (JWT).
     * POST /api/auth/login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email hoặc mật khẩu không đúng'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Cơ chế xoay vòng (Rotation): Hủy token cũ, cấp token mới.
     * JWT-Auth sẽ tự động đưa token cũ vào Blacklist.
     * POST /api/auth/refresh
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Đăng xuất — đưa token vào Blacklist.
     * POST /api/auth/logout
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    /**
     * Lấy thông tin user đang đăng nhập.
     * GET /api/auth/me
     */
    public function me()
    {
        return response()->json(auth('api')->user()->load('role'));
    }

    /**
     * Chuẩn hóa response trả về token.
     */
    protected function respondWithToken(string $token, int $statusCode = 200)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => config('jwt.ttl') * 60, // giây
            'user'         => auth('api')->setToken($token)->user(),
        ], $statusCode);
    }
}
