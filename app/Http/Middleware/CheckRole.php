<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // تأكد من أن المستخدم متواجد وله الدور المطلوب
        if (!$user || !$user->role || !in_array($user->role->name, $roles)) {
            return redirect('/'); // إعادة التوجيه إلى الصفحة الرئيسية أو صفحة خطأ
        }

        return $next($request);
    }
}
