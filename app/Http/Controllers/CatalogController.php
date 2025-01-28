<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use App\Services\Sorter;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Group $group = null)
    {
        $groups = Group::where('id_parent', null)->with('children')->get();
        $sorter = new Sorter(['price', 'name']);
        $products = Product::with('prices')->sorted()->paginate();
        $breadcrumbs = $this->getBreadcrumbs($group);
        return view('catalog.index', compact('groups', 'products', 'sorter', 'breadcrumbs'));
    }


    public function show(Group $group)
    {
        $groups = Group::where('id_parent', null)->with('children')->get();
        $products = Product::where('id_group', $group->id)->sorted()->paginate();
        $subgroups = Group::query()->select(['id', 'name', 'id_parent'])->has('products')->get();
        $breadcrumbs = $this->getBreadcrumbs($group);

        return view('catalog.show', compact('group', 'groups', 'subgroups', 'products', 'breadcrumbs'));
    }


    private function getBreadcrumbs(Group $group = null)
    {
        $breadcrumbs = [
            (object) [
                'id' => null,
                'name' => 'Главная',
                'url' => route('catalog.index'),
            ]
        ];

        if ($group) {
            $chain = [];

            while ($group) {
                $chain[] = (object) [
                    'id' => $group->id,
                    'name' => $group->name,
                    'url' => route('catalog.show', $group->id)
                ];

                $group = $group->parent;
            }
            $breadcrumbs = array_merge($breadcrumbs, array_reverse($chain));
        }

        return $breadcrumbs;
    }


}
