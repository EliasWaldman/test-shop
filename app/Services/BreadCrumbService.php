<?php

namespace App\Services;

use App\Models\Group;

class BreadcrumbService
{
    /**
     * Метод для формирования хлебных крошек
     * @param Group|null $group
     * @return array
     */
    public function generateBreadcrumbs(?Group $group = null)
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
