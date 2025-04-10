<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // 2MB limit
            'status' => 'required|in:draft,published',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = Str::slug($request->title) . '-' . time();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validatedData['status'] === 'published') {
            $validatedData['published_at'] = now();
        }

        Article::create($validatedData);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        if ($article->status === 'draft' && Auth::id() !== $article->user_id) {
            abort(403);
        }

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        // Only update slug if title has changed
        if ($article->title !== $request->title) {
            $validatedData['slug'] = Str::slug($request->title) . '-' . time();
        }

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            
            $validatedData['image'] = $request->file('image')->store('articles', 'public');
        }

        // Update published_at if status changes to published
        if ($validatedData['status'] === 'published' && $article->status === 'draft') {
            $validatedData['published_at'] = now();
        }

        $article->update($validatedData);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if (Auth::id() !== $article->user_id) {
            abort(403);
        }

        // Delete associated image
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    // Admin management
    public function adminIndex()
    {
        $this->authorize('admin');
        
        $articles = Article::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.articles.index', compact('articles'));
    }
}
