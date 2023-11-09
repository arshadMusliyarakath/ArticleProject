<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'article_id';
    protected $guarded = [];

    public function category(){
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }

    public function getAllTagsAttribute(){
        $arr = [];
        $tags =  json_decode($this->tags);
        foreach($tags as $tag){
            $tag = Tag::select('name')->where('tag_id', $tag)->first();
            $arr[] = $tag->name;
            
        }
        return $arr;
    }

    protected $appends = ['AllTags'];
}
