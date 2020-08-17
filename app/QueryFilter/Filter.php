<?php


namespace App\QueryFilter;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())) {
            return $next($request);
        }

        return $this->applyFilter($next($request));
    }

    private function applyFilter($param)
    {
        return $param->filter(function($key)  {
            return Str::contains(Str::lower($key[$this->filterName()]), Str::lower(request()->get($this->filterName())));
        })->values();
    }

    private function filterName()
    {
        return Str::snake(Str::lower(class_basename($this)));
    }

}
