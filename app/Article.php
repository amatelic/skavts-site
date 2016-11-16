<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;


class Article extends Model
{
  protected $table = 'articles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'body', 'image_dir'];

  public function scopegetImagesPath($query, $type)
  {
    return Storage::disk('public')->allFiles("/photos/" . $type);
  }
  public function scopeDeleteImage($query, $path)
  {
    return Storage::disk('public')->delete($path);
  }
}
