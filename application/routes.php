<?php

Route::create(
    "GET", "/items/viewall/([0-9]{1,6})", "ItemsController", "viewall", "items.viewall", ["id"]);
Route::create("GET", "/items/([0-9]{1,6})", "ItemsController", "show", "items.view", ["id"]);
Route::create("GET", "/items/([0-9]{1,6})/bla", "ItemsController", "show", "items.view.bla", ["id"]);
Route::create("POST", "/items/add", "ItemsController", "add", "items.add");
