<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller{
    private $path = 'articles.json';

    public function index()
    {
        if (!Storage::disk('local')->exists('articles.json')) {
            $articles = [];
        } else {
            $json = Storage::disk('local')->get('articles.json');
            $articles = json_decode($json, true) ?? [];
        }

        return view('welcome', ['allArticles' => $articles]);
    }

    public function show($id) {
        $json = Storage::disk('local')->get($this->path);

        $articles = collect(json_decode($json, true));

        $podcast = $articles->firstWhere('id', (int)$id);

        if (!$podcast) abort(404);

        return view('podcasts.show', compact('podcast'));
    }

    public function showDouble(Request $request)
    {
        $json = Storage::disk('local')->get($this->path);
        $articles = json_decode($json, true);

        $newArticle = [
            'id' => count($articles) + 1,
            'title' => $request -> input('title'),
            'author' => $request -> input('author'),
            'category' => $request -> input('category'),
            'description' => $request -> input('description'),
            'time' => now()->format('d.m.Y H:i')
        ];

        $articles[] = $newArticle;

        Storage::disk('local')->put($this->path, json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect('/')->with('success', 'Додано успішно!');
    }

    public function editOrUpdate(Request $request, $id) {
        $json = Storage::disk('local')->get($this->path);
        $articles = collect(json_decode($json, true));

        $index = $articles->search(fn($item) => $item['id'] == $id);

        if ($index === false) abort(404);

        $podcast = $articles[$index];

        if ($request->isMethod('post')) {
            $updatedData = [
                'id'          => (int)$id,
                'title'       => $request->input('title'),
                'author'      => $request->input('author'),
                'category'    => $request->input('category'),
                'text'        => $request->input('description'),
                'date'        => now()->format('d.m.Y')
            ];

            $articles[$index] = $updatedData;

            Storage::disk('local')->put(
                $this->path,
                json_encode($articles->values(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

            return redirect('/')->with('success', 'Оновлено!');
        }

        return view('podcasts.edit', compact('podcast'));
    }
}
