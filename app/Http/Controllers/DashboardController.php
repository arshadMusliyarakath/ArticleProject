<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $categories = Category::all();
        $tags = Tag::all();
        $articles = Article::where('auther_id', auth()->guard('author')->user()->auther_id)->latest()->get();
        return view('dashboard.dashboard', compact('categories', 'tags', 'articles'));
    }


    public function categories(){
        $categories = Category::all();
        return view('dashboard.category', compact('categories'));
    }

    public function createCategory(){
        $data = ['name' => request('name')];
        Category::create($data);
        return redirect()->route('categories');
    }
    public function deleteCategory($category_id){
        Category::find(decrypt($category_id))->delete();
        return redirect()->route('categories');
    }

    public function tags(){
        $tags = Tag::all();
        return view('dashboard.tag', compact('tags'));
    }

    public function createTag(){
        $data = ['name' => request('name')];
        Tag::create($data);
        return redirect()->route('tags');
    }
    public function deleteTag($tag_id){
        Tag::find(decrypt($tag_id))->delete();
        return redirect()->route('tags');
    }

    public function addBlog(){
        $data = [
            'title' => request('title'),
            'auther_id' => auth()->guard('author')->user()->auther_id,
            'description' => request('description'),
            'category_id' => request('category'),
            'tags' => json_encode(request('tags')),
        ];

        if(request()->hasFile('image')){
            $ext = request('image')->extension();
            $filename = time().'.'.$ext;
            if(request('image')->storeAs('BlogImages', $filename)){
                $data['image'] = $filename;
            }          
        }
          
        Article::create($data);
        return redirect()->route('dashboard');
    }

    public function editBlog(){
        $article = Article::find(request('article_id'));
        $data = [
            'title' => request('title'),
            'auther_id' => auth()->guard('author')->user()->auther_id,
            'description' => request('description'),
            'category_id' => request('category'),
            'tags' => json_encode(request('tags')),
        ];
        if(request()->hasFile('image')){
            $ext = request('image')->extension();
            $filename = time().'.'.$ext;
            if(request('image')->storeAs('BlogImages', $filename)){
                $data['image'] = $filename;
            }          
        }
        else{
            $data['image'] = request('image-old');
        }
        $article->update($data);
        return redirect()->route('dashboard');
    }

    public function deleteBlog($article_id){
        Article::find(decrypt($article_id))->delete();
        return redirect()->route('dashboard');
    }

    public function homePage(){
        $articles = Article::all();
        return view('home', compact('articles'));
    }

}
