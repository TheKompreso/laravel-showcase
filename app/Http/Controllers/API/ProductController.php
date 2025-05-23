<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\ProductsRequest;
use App\Http\Resources\API\ProductCollection;
use App\Models\Product;

class ProductController
{
    public function index(ProductsRequest $request): ProductCollection
    {
        $validated = $request->validated();
        return ProductCollection::make(
            Product::with(['productProperties', 'productProperties.property'])->when(isset($validated['properties']), function ($query) use ($validated) {
                foreach ($validated['properties'] as $property_key => $property_values) {
                    foreach ($property_values as $value) {
                        $query->whereHas('productProperties', function ($query) use ($value, $property_key, $property_values, $validated) {
                            $query->whereHas('property', function ($query) use ($property_key, $validated) {
                                $query->where('name', $property_key);
                            })->where('value', $value);
                        });
                    }
                }
            })->paginate($validated['per_page'] ?? config('api.products.per_page', 40))
        );
    }
}
