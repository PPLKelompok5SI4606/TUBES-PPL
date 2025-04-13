<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();

        $userCount = User::where('role', 'user')->count();

        $adminCount = User::where('role', 'admin')->count();

        $publishedArticles = Article::where('status', 'published')->count();

        $unpublishedArticles = Article::where('status', 'draft')->count();

        return view('dashboard.articles', compact('articles', 'userCount', 'adminCount', 'publishedArticles', 'unpublishedArticles'));
    }

    public function store(){
        try {
            $dataValidate = request()->validate([
                'title' => 'required',
                'content' => 'required',
                'status' => 'required|in:published,draft',
                'image' => 'required|mimes:png,jpg,jpeg|max:10000'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        $imagePath = request()->file('image')->store('images', 'public');
        $dataValidate['image'] = $imagePath;
        
        Article::create([
            'title' => $dataValidate['title'],
            'content' => $dataValidate['content'],
            'image' => $dataValidate['image'],
            'status' => $dataValidate['status'],
            'user_id' => Auth::user()->id,
            'published_at' => $dataValidate['status'] == 'published' ? now() : null,
            'slug' => str()->slug($dataValidate['title'])
        ]);

        return redirect()->route('admin.home')->with('success', 'Article created successfully');
    }

    public function update(Request $article, $id){
        try {
            $article->validate([
                'editTitle' => 'required|string',
                'editContent' => 'required|string',
                'editStatus' => 'required|in:published,draft',
                'image' => 'mimes:png,jpg,jpeg|max:10000'
            ]);

            $editArticle = Article::find($id);

            $editArticle->update([
                'title' => $article['editTitle'],
                'content' => $article['editContent'],
                'slug' => str()->slug($article['editTitle']),
            ]);

            if ($article->hasFile('image')) {
                $imagePath = $article->file('image')->store('images', 'public');

                $editArticle->update([
                    'image' => $imagePath
                ]);
            }

            Log::debug($article['editStatus']);
            Log::debug($editArticle['status']);

            if ($article->editStatus == 'published' && $editArticle->status != 'published') {
                $editArticle->update([
                    'status' => $article['editStatus'],
                    'published_at' => now(),
                ]);
            }

            if ($article->editStatus == 'draft' && $editArticle->status != 'draft') {
                $editArticle->update([
                    'status' => $article['editStatus'],
                    'published_at' => null,
                ]);
            }

            return redirect()->route('admin.home')->with('success', 'Article updated successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('dashboard.article-detail', compact('article'));
    }

    public function destroy($id){
        Article::find($id)->delete();
        return redirect()->route('admin.home')->with('success', 'Article deleted successfully');
    }

    public function listArticles(){
        $articles = Article::all()->where('status', 'published');
        return view('artikel.listArtikel', compact('articles'));
    }

    public function showArticle($id)
    {
        try {
            $article = Article::where('status', 'published')->findOrFail($id);
            return view('artikel.article-detail', compact('article'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Article not found');
        }
    }
}
