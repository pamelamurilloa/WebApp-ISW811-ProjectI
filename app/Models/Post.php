<?php
namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $id;
    
    public function __construct($title, $excerpt, $date, $body, $id)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->id = $id;
    }

    public static function find($post) {
        return static::all()->firstWhere('id', $post);
    }

    public static function all() {
        return collect(File::files(resource_path("posts")))
        ->map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function($document) {
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->id
            );
        });
    }
}