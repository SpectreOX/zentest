<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Snippet;
use App\Http\Resources\SnippetCollection;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\LinkCollection;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Http\Resources\FileCollection;
use App\Http\Resources\FileResource;
use App\Models\File;

class HomeController extends Controller
{
    public function snippets() {
        $snippets = Snippet::all();
        return new SnippetCollection($snippets);


    }
    public function files() {
        $files = File::all();
        return new FileCollection($files);


    }
    public function links() {
        $links = Link::all();
        return new LinkCollection($links);


    }
}
