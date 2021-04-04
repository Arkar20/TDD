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

        foreach ($this->getRequest() as $filter => $value) {
            if (method_exists($this, $filter)) {
                // dd('hello true');
                $this->$filter($value);
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
    private function getRequest()
    {
        return $this->request->only($this->filters);
    }
}
