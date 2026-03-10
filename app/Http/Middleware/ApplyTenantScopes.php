<?php

namespace App\Http\Middleware;

use App\Models\CompanyCertificate;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApplyTenantScopes
{
    public function handle(Request $request, Closure $next)
    {
        

        return $next($request);
    }
}
