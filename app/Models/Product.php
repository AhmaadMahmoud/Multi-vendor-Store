<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder as DatabaseEloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    use HasFactory;
    protected $guarded=[];


    protected static function booted()
    {
        static::addGlobalScope('store',function(EloquentBuilder $builder){
            $user = Auth::user();
            if($user && $user->store_id){
                $builder->where('store_id','=',$user->store_id);
            }
        });
    }
    public function category(){
            return $this->belongsTo(Category::class,'category_id');
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    public function getSalePercentageAttribute(){
        if(!$this->compare_price){
            return 0;
        }else{
            return number_format(100 - (100 * $this->price / $this->compare_price),1);
        }
    }
    nam

        public function scopeFilter(Builder $builder,$filters){
            $options = array_merge([
                'store_id' => null,
                'category_id' => null,
                'tags' => [],
                'status' => 'active'
            ],$filters);
            $builder->when($options['store_id'],function($builder,$value){
                $builder->where('store_id',$value);
            });
            $builder->when($options['category_id'],function($builder,$value){
                $builder->where('category_id',$value);
            });
            $builder->when($options['tags'],function($builder,$value){
                $builder->whereHas('tags',function($builder) use ($value){
                    $builder->whereIn('id',$value);
                });
            });
        }
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
