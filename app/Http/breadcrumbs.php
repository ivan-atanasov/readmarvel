<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.home'), route('admin.dashboard'));
});

// Home > Static pages
Breadcrumbs::register('static_pages', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.static_pages'), route('admin.static.index'));
});

// Home > Static pages > Create
Breadcrumbs::register('static_pages_create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.static_pages'), route('admin.static.index'));
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.create'), route('admin.static.create'));
});

// Home > Static pages > Edit
Breadcrumbs::register('static_pages_edit', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.static_pages'), route('admin.static.index'));
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.edit'), route('admin.static.edit', $page->id));
});

// Home > Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(Lang::get('admin/breadcrumbs.users'), route('admin.users.index'));
});