<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Middleware xác thực JWT cho các route API.
 *
 * Luồng xử lý:
 * 1. Kiểm tra token trong header Authorization: Bearer {token}
 * 2. Xác thực token hợp lệ, chưa hết hạn, chưa bị blacklist
 * 3. Nếu token hết hạn nhưng chưa quá refresh_ttl → trả header gợi ý client gọi /refresh
 * 4. Gắn user vào request để các controller sử dụng
 */
class JwtAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'error'   => 'user_not_found',
                    'message' => 'Không tìm thấy user cho token này',
                ], 404);
            }

        } catch (TokenExpiredException $e) {
            // Token hết hạn — client nên gọi POST /api/auth/refresh
            return response()->json([
                'error'   => 'token_expired',
                'message' => 'Token đã hết hạn, vui lòng refresh token',
            ], 401);

        } catch (TokenInvalidException $e) {
            return response()->json([
                'error'   => 'token_invalid',
                'message' => 'Token không hợp lệ',
            ], 401);

        } catch (JWTException $e) {
            return response()->json([
                'error'   => 'token_absent',
                'message' => 'Không tìm thấy token trong request',
            ], 401);
        }

        return $next($request);
    }
}
