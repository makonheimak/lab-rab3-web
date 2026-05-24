<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait FiltersApiQuery
{
    protected function applyBaseFilters(Builder $query, Request $request): Builder
    {
        if ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $request->query('created_from'));
        }

        if ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $request->query('created_to'));
        }

        if ($request->filled('q')) {
            $q = $request->query('q');
            $query->where(function (Builder $builder) use ($q) {
                foreach (['name', 'title', 'full_name', 'number', 'sku'] as $column) {
                    try {
                        $builder->orWhere($column, 'like', '%' . $q . '%');
                    } catch (\Throwable) {
                        // Database grammar errors are ignored because the package supports several entity schemas.
                    }
                }
            });
        }

        return $query;
    }

    protected function perPage(Request $request): int
    {
        $max = (int) config('ecommerce-suite.pagination.max_per_page', 100);
        return min((int) $request->query('per_page', config('ecommerce-suite.pagination.per_page', 10)), $max);
    }
}
