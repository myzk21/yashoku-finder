<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});
// Home > ぴったりの夜食
Breadcrumbs::for('suggestion', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('ぴったりの夜食', route('recipe.suggestion'));
});
// Home > レシピ一覧
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('レシピ一覧', route('recipe.index'));
});
// Home > ぴったりの夜食 > レシピ詳細
Breadcrumbs::for('show_from_suggestion', function (BreadcrumbTrail $trail, $recipe) {
    $trail->parent('home');
    $trail->push($recipe['title'], route('recipe.show', $recipe['id']));
});
// Home > レシピ一覧 > レシピ詳細
Breadcrumbs::for('show', function (BreadcrumbTrail $trail, $recipe) {
    $trail->parent('index');
    $trail->push($recipe['title'], route('recipe.show', $recipe['id']));
});
// Home > レシピ作成
Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('レシピ作成', route('recipe.create'));
});
//レシピ編集
Breadcrumbs::for('edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('レシピ編集');
});
