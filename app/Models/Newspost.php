<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspost extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'newsposts';

    protected $fillable = [
      'title',
      'details',
      'category',
      'custom_url',
      'tags',
      'story_external_source_name',
      'story_external_source_url',
      'image_external_source_credit',
      'image_external_source_url',
      'user_id',
      'created_at',
      'updated_at'
    ];
}
