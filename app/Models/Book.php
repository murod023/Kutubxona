<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Указываем, какие поля могут быть массово заполняемыми
    protected $fillable = [
        'title',
        'author',
        'year',
        'file_path', // убедитесь, что это поле включено
    ];
}
