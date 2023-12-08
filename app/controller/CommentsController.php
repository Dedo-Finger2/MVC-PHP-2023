<?php

namespace App\controller;

class CommentsController extends Controller
{
    public static function comments()
    {
        $contentView = self::render("comments", [

        ]);

        return self::view([
            "title" => 'Comments',
            "content" => $contentView
        ]);
    }
}
