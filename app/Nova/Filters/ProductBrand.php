<?php

namespace App\Nova\Filters;

use App\Models\Brand;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;


class ProductBrand extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';
  


    /**
     * Apply the filter to the given query.
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query->where('brand_id', $value); 
    }

    /**
     * Get the filter's available options.
     *
     * @return array<string, string>
     */
    public function options(NovaRequest $request): array
    {
        $newOptions = [];

        foreach(Brand::all() as $brand){
            $newOptions[$brand->name]=$brand->id;
        }
        return $newOptions;
    }
}
