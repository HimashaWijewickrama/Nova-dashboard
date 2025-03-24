<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Slug::make('Slug')->from('name')->required()->withMeta([
                'extraAttributes' => [
                    'readonly' => true
                ]
            ])->placeholder('Enter Product Slug...')->showOnIndex()->textAlign('center'),
            Text::make('Name')->required()->showOnPreview()->placeholder('Enter Product Name...')->textAlign('center'),
            Markdown::make('Description')->required()->placeholder('Enter Description...')->textAlign('center'),
            Currency::make('Price')->currency('LKR')->required()->showOnPreview()->placeholder('Enter Price...')->textAlign('center'),
            Text::make('Sku (Stock Keep Unit)')->required()->placeholder('sku')->placeholder('Enter SKU...')->textAlign('center')->help('Number that relailers use to differentiate products and track the inventory levels.'),
            Number::make('Quantity')->required()->showOnPreview()->placeholder('Enter Quantity...')->textAlign('center'),
            Boolean::make('Status', 'is_published')->required()->showOnPreview()->textAlign('center'),

        ];
    }

    /**
     * Get the cards available for the resource.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
