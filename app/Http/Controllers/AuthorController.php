<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Image;


class AuthorController extends Controller
{
    public function findBySearchTerm(string $searchTerm)
    {
        $author = Author::with([])
            ->where('firstName', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('lastName', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return $author;
    }
}
