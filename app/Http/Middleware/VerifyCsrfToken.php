<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'bread/updateCardTable/*',
        'bread/deleteCardTable/*',
        'bread/test/',
    ];


//    protected function excludeRoutes($request)
//    {
//        $excludedRoutes = [
//            'bread/updateCardTable/*', // Tên route cần bỏ qua bảo vệ CSRF
//            'bread.updateCardTable', // Tên route cần bỏ qua bảo vệ CSRF
//        ];
//
//        foreach ($excludedRoutes as $route) {
//            if ($request->is($route)) {
//                return true;
//            }
//        }
//
//        return false;
//    }
}
