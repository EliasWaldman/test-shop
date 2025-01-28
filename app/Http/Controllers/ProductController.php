<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {

        $product = Product::findOrFail($id);
        $price = Price::where('id_product', $id)->first();
        $groups = Group::where('id_parent', null)->with('children')->get();
        $breadcrumbs = $this->getBreadcrumbs($product->id_group);
        return view('products.show', compact('product', 'price', 'breadcrumbs', 'groups'));
    }

    private function getBreadcrumbs($groupId)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = (object) [
            'id' => null,
            'name' => 'Главная',
            'url' => route('catalog.index')
        ];
        $chain = [];
        while ($groupId) {
            $group = Group::find($groupId);
            if (!$group) {
                break;
            }
            array_unshift($chain, (object) [
                'id' => $group->id,
                'name' => $group->name,
                'url' => route('catalog.show', $group->id)
            ]);
            $groupId = $group->id_parent;
        }
        $breadcrumbs = array_merge($breadcrumbs, $chain);

        return $breadcrumbs;
    }
}
