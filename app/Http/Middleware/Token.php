<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return \Inertia\Response|JsonResponse|Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Inertia\Response|JsonResponse|Response|RedirectResponse
    {
        /** @var User $user */
        $user = $request->user ?? null;
        if (!isset($user->expired_at) || Carbon::now() > Carbon::parse($user->expired_at)) {
            return Inertia::render('Error', ['status' => 403]);
        }
        return $next($request);
    }
}
