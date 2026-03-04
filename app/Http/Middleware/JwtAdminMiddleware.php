<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware kiểm tra quyền admin qua JWT (API guard).
 * Dùng cho các route API dành riêng cho admin.
 */
class JwtAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();

        if (!$user || $user->role_id != 2) {
            return response()->json([
                'error'   => 'forbidden',
                'message' => 'Bạn không có quyền truy cập tài nguyên này',
            ], 403);
        }

        return $next($request);
    }
}
