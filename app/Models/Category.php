<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name' , 'slug' ,'image' ,'parent_id','description','status'
    ];

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function childreen(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public  function scopeActive(Builder $builder)
    {
        $builder->where('status','=','active');
    }
    public static function rules($id = 0){
        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id' => ['nullable','int','exists:categories,id'],
            'image' => ['image','max:1024'],
            'status' => 'in:active,archived'
        ];
    }
}
