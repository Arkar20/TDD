<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $builders;
    protected $filters = [];
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply($builders)
    {
        $this->builders = $builders;

        foreach ($this->filters as $filter) {
            if ($this->hasFilters($filter)) {
                // dd('hello true');
                $this->$filter($this->request->$filter);
            }
        }
        // if ($this->request->has('by')) {
        //     $this->by($this->request->by);
        // }
        return $this->builders;
    }
    private function hasFilters($filter): bool
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}
