<?php

namespace App\controller;

class ProductController extends Controller
{
    public static function products(int $id)
    {
        $viewContent = self::render("pagination", [
            "id"=> $id,
        ]);

        return self::view([
            'title' => 'Products',
            'content' => $viewContent,
        ]);
    }
}
