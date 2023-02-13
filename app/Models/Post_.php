<?php

namespace App\Models;



class Post 
{
    private static $blog_post = [
        [
            "title" => "Blog Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Aditya Wardana",
            "body" => "
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis ipsa aliquam voluptatum iste eveniet reiciendis vel inventore quisquam exercitationem, vitae, velit, nisi commodi mollitia dicta reprehenderit! Corrupti doloremque exercitationem recusandae unde, et ipsa non? Architecto necessitatibus saepe, consectetur officiis nisi eos beatae harum cupiditate quos pariatur illo voluptates reiciendis amet, quod nostrum. Inventore, distinctio maxime? Nemo labore, corrupti voluptatibus velit vitae animi quod fugiat quasi alias? Repellat molestias dicta beatae fugit porro culpa iste dolores, deserunt illum expedita, ab voluptate rerum vitae officiis deleniti quos odio non, aliquam neque. Adipisci."
        ],
        [
            "title" => "Blog Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Rai Asih",
            "body" => "
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis ipsa aliquam voluptatum iste eveniet reiciendis vel inventore quisquam exercitationem, vitae, velit, nisi commodi mollitia dicta reprehenderit! Corrupti doloremque exercitationem recusandae unde, et ipsa non? Architecto necessitatibus saepe, consectetur officiis nisi eos beatae harum cupiditate quos pariatur illo voluptates reiciendis amet, quod nostrum. Inventore, distinctio maxime? Nemo labore, corrupti voluptatibus velit vitae animi quod fugiat quasi alias? Repellat molestias dicta beatae fugit porro culpa iste dolores, deserunt illum expedita, ab voluptate rerum vitae officiis deleniti quos odio non, aliquam neque. Adipisci."
        ]   
    ];

    public static function all()
    {
        return collect (self::$blog_post);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
