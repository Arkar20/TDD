<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $builders;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply($builders)
    {
        $this->builders = $builders;
        if ($this->request->has('by')) {
            $this->by($this->request->by);
        }

        return $this->builders;
    }
}
