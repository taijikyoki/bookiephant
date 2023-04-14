<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public static $sortBy = 'id';

    public static $filter = [
        'title' => '',
        'author' => '', 
        'year' => ''
    ];

    public static function getFiltered($title = '', $year = '') {

        $query = Book::where('title', 'LIKE', '%'.$title.'%');

        if ($year != '' and is_numeric($year)) {
            $query = $query->where('release_year', '=', $year);
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
