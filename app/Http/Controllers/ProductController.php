<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Price;
use App\Models\Product;
use App\Services\BreadcrumbService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(BreadcrumbService $breadcrumbService)
    {
        $this->breadcrumbService = $breadcrumbService;
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $price = Price::where('id_product', $id)->first();
        $groups = Group::where('id_parent', null)->with('children')->get();

        $group = Group::find($product->id_group);
        $breadcrumbs = $this->breadcrumbService->generateBreadcrumbs($group);

        return view('products.show', compact('product', 'price', 'breadcrumbs', 'groups'));
    }

}
