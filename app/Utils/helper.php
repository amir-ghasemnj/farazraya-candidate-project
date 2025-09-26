<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

if (!function_exists('formatPagination')) {
    /**
     * Return a standardized pagination array from a paginator.
     *
     * @param LengthAwarePaginator|Paginator $paginator
     * @return array
     */
    function formatPagination(LengthAwarePaginator|Paginator $paginator): array
    {
        return [
            'total' => $paginator->total() ?? null,
            'per_page' => $paginator->perPage() ?? null,
            'current_page' => $paginator->currentPage() ?? null,
            'last_page' => method_exists($paginator, 'lastPage') ? $paginator->lastPage() : null,
            'from' => $paginator->firstItem() ?? null,
            'to' => $paginator->lastItem() ?? null,
        ];
    }
}
