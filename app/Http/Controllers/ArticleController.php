<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
<<<<<<< HEAD
=======
use Illuminate\Support\Str;
>>>>>>> e187f3f659f9985c7d1c33182d61e7e399fff100

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

        } else {
            $imagePath = null;
        }

        $article = new Article([
        'title' => $request->title,
        'content' => $request->content,
        'author' => $request->author,
        'category' => $request->category,
        'slug' => $request->slug,
        'published_at' => $request->published_at,
        'image' => $imagePath,
        ]);

        // dd($article);

        $article->save();

        return redirect()->route('article.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        return view('articles.show', compact('article', 'articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
<<<<<<< HEAD
        $validated = $request->validate([
=======

          $request->validate([

>>>>>>> e187f3f659f9985c7d1c33182d61e7e399fff100
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'published_at' => 'nullable|date',
          ]);

<<<<<<< HEAD
        // Validasi dan proses file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            
            // Upload gambar baru
            $validated['image'] = $request->file('image')->store('images', 'public');
=======
          try {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'category' => $request->category,
                'slug' => $request->slug ?? Str::slug($request->title),
                'published_at' => $request->published_at,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($article->image) {
                    Storage::disk('public')->delete($article->image);
                }
                // Store new image
                $data['image'] = $request->file('image')->store('images', 'public');
            } else {
                // Keep existing image
                $data['image'] = $article->image;
            }

            $article->update($data);

            return redirect()->route('article.index')->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('article.edit', $article->slug)->with('error', 'Failed to update article: ' . $e->getMessage());
>>>>>>> e187f3f659f9985c7d1c33182d61e7e399fff100
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
<<<<<<< HEAD
        // Hapus gambar dari storage jika ada
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // Hapus record dari database
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
=======
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article deleted successfully.');
>>>>>>> e187f3f659f9985c7d1c33182d61e7e399fff100
    }
}
