<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'author',
        'release_year',
        'genre',
    ];

    public static function getFiltered($title = '', $year = '', $authorName = '', $filterGenres = []) {

        $query = Book::where('title', 'LIKE', '%'.$title.'%');

        if ($year != '' and is_numeric($year)) {
            $query = $query->where('release_year', '=', $year);
        }

        $query = $query->whereHas('author', function($author) use($authorName) {
            $author->where('name', 'LIKE', '%'.$authorName.'%');
        });

        if (!empty($filterGenres)) {

            $query = $query->with(['genres' => function($nquery) use ($filterGenres) {
                $nquery->whereIn('id', array_column($filterGenres, 'value'));
            }]);
        }

        return $query;
    }

    public function author() {
        return $this->belongsTo(Author::class);
    }
    
    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
}
