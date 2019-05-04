<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Image;
use App\Author;


class BookController extends Controller
{
    //liefert die Liste aller Bücher zurück
    public function index()
    {
        /**
         * load all books and relations with eager loading
         * lazy loading: ich bekomme die Daten von den Büchern, aber nicht den Autoren, die müssen nachgeladen werden
         * eager loading: alles soll gleich mitgeladen werden (Authoren, Bilder,...)
         */
        $books = Book::with(['authors', 'images', 'user'])->get();
        return $books;

    }

    //Detailansicht von einem Buch (mittels id)
    public function show($book)
    {
        $book = Book::with('authors', 'images', 'orders')->find($book);
        dd($book);
        return view('books.show', compact('book'));
    }

    public function findByISBN(string $isbn): Book
    {
        $book = Book::where('isbn', $isbn)
            ->with(['authors', 'images', 'user'])
            ->first();
        //first nicht get. weil bei get würd ich den ganzen array bekommen
        return $book;
    }

    public function checkISBN(string $isbn)
    {
        $book = Book::where('isbn', $isbn)->first();
        //das first brauch ich, weil bei sql where mehrere bücher zurückkommen können ?!
        return $book != null ? response()->json('book with ' . $isbn . ' exists', 200) :
            response()->json('book with ' . $isbn . ' does not exist', 404);
    }

    /**
     * find book by search term
     * SQL injection is prevented by default, because Eloquent
     * uses PDO parameter binding
     */
    public function findBySearchTerm(string $searchTerm)
    {
        $book = Book::with(['authors', 'images', 'user'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('subtitle', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            /* search term in authors name */
            ->orWhereHas('authors', function ($query) use ($searchTerm) {
                $query->where('firstName', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('lastName', 'LIKE', '%' . $searchTerm . '%');
            })->get();
        return $book;
    }


    /**
     * create new Book
     */
    public function save(Request $request): JsonResponse
    {

        $request = $this->parseRequest($request);
        /*+
        *  use a transaction for saving model including relations
        * if one query fails, complete SQL statements will be rolled back
        */
        DB::beginTransaction();
        //das beginTransaction brauch ich, damit nichts hinzugefügt wird oder alles
        //keine halben Sachen bei Fehlern
        try {
            $book = Book::create($request->all());

            // save images
            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
                    $book->images()->save($image);
                }
            }


            if (isset($request['authors']) && is_array($request['authors'])) {
                foreach ($request['authors'] as $auth) {
                    $author = Author::firstOrNew([
                        'firstName' => $auth['firstName'],
                        'lastName' => $auth['lastName']
                    ]);
                    $book->authors()->save($author);
                }
            }

            //save order
            if($request['orders']&& is_array($request['orders'])){
                foreach ($request['orders'] as $ord){
                    $order = Order::firstOrNew([
                        'total_price' => $ord['total_price'],
                        'state' => $ord['state'],
                        'comment' => $ord['comment'],
                        'user_id' => $ord['user_id']
                    ]);

                    $book->orders()->save($order);
                }
            }

            DB::commit();
            // return a vaild http response
            return response()->json($book, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }
    }


    /**
     * modify / convert values if needed
     */
    private function parseRequest(Request $request): Request
    {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }


    /**
     * @param Request $request
     * @param string $isbn
     * @return JsonResponse
     * wir holen uns ein Buch, wenn es gefunden wurde möchten wir es mit unserem
     * mitgegebenen Parameter updaten.
     */
    public function update(Request $request, string $isbn): JsonResponse
    {
        DB::beginTransaction();
        try {
            $book = Book::with(['authors', 'images', 'user'])
                ->where('isbn', $isbn)->first();
            if ($book != null) {
                $request = $this->parseRequest($request);
                $book->update($request->all());

                //delete all old images
                $book->images()->delete();
                // save images
                if (isset($request['images']) && is_array($request['images'])) {
                    foreach ($request['images'] as $img) {
                        $image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
                        $book->images()->save($image);
                    }
                }
                //update authors

                $ids = [];
                if (isset($request['authors']) && is_array($request['authors'])) {
                    foreach ($request['authors'] as $auth) {
                        array_push($ids, $auth['id']);
                    }
                }
                $book->authors()->sync($ids);
                $book->save();

            }
            DB::commit();
            $book1 = Book::with(['authors', 'images', 'user'])
                ->where('isbn', $isbn)->first();
            // return a vaild http response
            return response()->json($book1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating book failed: " . $e->getMessage(), 420);

        }
    }


    /**
     * returns 200 if book deleted successfully, throws excpetion if not
     */
    public function delete(string $isbn): JsonResponse
    {
        $book = Book::where('isbn', $isbn)->first();
        if ($book != null) {
            $book->delete();
        } else
            throw new \Exception("book couldn't be deleted - it does not exist");
        return response()->json('book (' . $isbn . ') successfully deleted', 200);

    }
}
