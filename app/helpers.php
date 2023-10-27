<?php

use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Size;
use App\Models\Tag;

function getAllGroups()
{
    return Group::all();
}

function getAllCategories()
{
    return Category::all();
}

function getAllColors()
{
    return Color::all();
}

function getAllSizes()
{
    return Size::all();
}

function getAllTags()
{
    return Tag::all();
}

function categoriesProducts()
{
    $categories = Category::all();

    $categoryWithProductCount = [];

    foreach ($categories as $category) {
        $categoryWithProductCount[] = [
            'category' => $category,
            'product_count' => $category->products->count()
        ];
    }
    return $categoryWithProductCount;
}

function menuSelect($menu, $parent = 0, $level = 0)
{
    if ($menu->count() > 0) {
        $result = [];
        foreach ($menu as $key => $category) {
            if ($category['category_id'] == $parent) {
                $category['level'] = $level;
                $result[] = $category;
                $child = menuSelect($menu, $category['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
}

function menuTreeCategory($menu, $parentId = 0)
{
    if ($menu->count() > 0) {
        foreach ($menu as $key => $category) {
            if ($category['category_id'] == $parentId) {
                echo '<li><a class="d-flex justify-content-between" href ="' . route('dashboard.category.edit', $category['id']) . '" title="Click xem thêm"> <span>' . $category['name'] . '</span> </a>';
                echo '<ul >';
                echo menuTreeCategory($menu, $category['id']);
                echo '</ul>';
                echo '</li>';
                echo '</li>';
            }
        }
    }
}

function isRole($dataArr, $module, $role = 'view')
{
    if (!empty($dataArr)) {
        $roleArr = $dataArr[$module] ?? [];
        if (!empty($roleArr) && in_array($role, $roleArr)) {
            return true;
        }
    }
    return false;
}
