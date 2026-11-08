<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\SiteService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasValidSiteIdMiddleware
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientId = $request->header('AB-Testing-Site-ID');

        if ($clientId === null) {
            return new HttpResponse(status: 404);
        }

        $site = app(SiteService::class)->findByClientId($clientId);

        if ($site === null) {
            return new HttpResponse(status: 404);
        }

        return $next($request);
    }
}
