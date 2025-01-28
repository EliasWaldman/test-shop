<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use App\Services\BreadcrumbService;
use App\Services\Sorter;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(BreadcrumbService $breadcrumbService, protected Sorter $sorter)
    {
        $this->breadcrumbService = $breadcrumbService;
    }

    public function index(Group $group = null)
    {
        $sortOptions = $this->sorter->getSortOptions();
        $groups = Group::where('id_parent', null)->with('children')->get();
        $sorter = new Sorter(['price', 'name']);
        $products = Product::with('prices')->sorted()->paginate();

        $breadcrumbs = $this->breadcrumbService->generateBreadcrumbs($group);
        return view('catalog.index', compact(
            'groups',
            'products',
            'sorter',
            'breadcrumbs',
            'sortOptions'
        ));
    }


    public function show(Group $group)
    {
        $sortOptions = $this->sorter->getSortOptions();

        $groups = Group::where('id_parent', null)->with('children')->get();
        $products = Product::where('id_group', $group->id)->sorted()->paginate();
        $subgroups = Group::query()->select(['id', 'name', 'id_parent'])->has('products')->get();
        $breadcrumbs = $this->breadcrumbService->generateBreadcrumbs($group);

        return view('catalog.show', compact('group',
            'groups',
            'subgroups',
            'products',
            'breadcrumbs',
            'sortOptions'
        ));
    }

}
