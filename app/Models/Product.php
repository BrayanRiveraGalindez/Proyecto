<?php

namespace App\Models;

use App\Models\File;
use App\Models\Lend;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'category_id',
		'name',
		'price',
		'description',
		'stock',
		'color',
	];

	protected $appends = ['format_description'];

	public function formatDescription(): Attribute
	{
		return Attribute::make(
			get: function ($value, $attributes) {
				return Str::limit($attributes['description'], 70,  '...');
			},
			// set: fn ($value) => Str::upper($value)
		);
	}


	/*
	Book::with('category','Author')->get();
	*/

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function lends()
	{
		return $this->hasMany(Lend::class, 'book_id', 'id');
	}

	public function file()
	{
		return $this->morphOne(File::class, 'fileable');
	}

}
