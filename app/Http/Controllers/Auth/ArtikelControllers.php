<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Artikel::where('status', 'published')
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

        Artikel::create($validatedData);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Artikel $article)
    {
        if ($article->status === 'draft' && Auth::id() !== $article->user_id) {
            abort(403);
        }

        return view('articles.show', compact('article'));
    }

    public function edit(Artikel $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Artikel $article)
    {
        $this->authorize('update', $article);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $validatedData['slug'] = Str::slug($request->title) . '-' . time();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validatedData['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validatedData['status'] === 'published' && !$article->published_at) {
            $validatedData['published_at'] = now();
        }

        $article->update($validatedData);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Artikel $article)
    {
        $this->authorize('delete', $article);

        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    public function adminIndex()
    {
        $this->authorize('viewAny', Artikel::class);
        
        $articles = Artikel::orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('articles.admin.index', compact('articles'));
    }
}
