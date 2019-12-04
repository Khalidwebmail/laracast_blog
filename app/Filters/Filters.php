<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Collection ;

abstract class Filters
{
    protected $request,  $builder;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        // foreach($this->getFilters() as $filter => $value)
        // {
        //     if(method_exists($this, $filter))
        //     {
        //         $this->$filter($value);
        //     }

        //     return $this->builder;
        // }
        $this->getFilters()
            ->filter(function($filter) {
                return method_exists($this, $filter);
            })
            ->each(function($filter, $value) {
                $this->$filter($value);
            });

        return $builder;
    }

    public function getFilters()
    {
        return collect($this->request->intersect($this->filters))->flip();
        // return $this->request->intersect($this->filters);
    }
}