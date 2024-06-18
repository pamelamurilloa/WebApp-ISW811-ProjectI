<?php
namespace App\Models;

use Illuminate\Support\Facades\File;

class Post
{
    public static function find($post) {
        $path = resource_path("posts/{$post}.html");

        if (! file_exists($path)) {
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{post}", now()->addMinutes(20), fn () => file_get_contents($path));

    }

    public static function all() {
        $files = File::files(resource_path("posts/"));
        return array_map(function ($file) {
            return $file->getContents();
        }, $files);
    }
}