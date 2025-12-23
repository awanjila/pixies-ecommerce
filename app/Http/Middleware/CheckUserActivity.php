<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;
use Carbon\Carbon;

class CheckUserActivity
{
    protected $session;
    protected $timeout = 120; // 2 minutes

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        $userLastActivity = $this->session->get('lastActivityTime');

        if ($userLastActivity !== null && Carbon::now()->diffInMinutes($userLastActivity) >= $this->timeout) {
            Auth::logout();

            return redirect('/login');
        }

        $this->session->put('lastActivityTime', Carbon::now());

        return $next($request);
    }
}
