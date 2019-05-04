<?php

namespace App\Http\Controllers;

use App\Order;
use App\Book;
use App\User;
use App\Orderlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;


class OrderController extends Controller
{
    //liefert die Liste aller Bücher zurück
    public function index()
    {

        /**
         * load all books and relations with eager loading
         * lazy loading: ich bekomme die Daten von den Büchern, aber nicht den Autoren, die müssen nachgeladen werden
         * eager loading: alles soll gleich mitgeladen werden (Authoren, Bilder,...)
         */
        $orders = Order::with(['user', 'books', 'orderlogs'])
            ->orderBy('user_id', 'desc')
            ->get();
        return $orders;

    }


    public function save(Request $request): JsonResponse
    {


        DB::beginTransaction();

        try {
            $order = Order::create($request->all());


            // save books
            if (isset($request['books']) && is_array($request['books'])) {
                foreach ($request['books'] as $book) {
                    $book = Book::firstOrNew([
                        'id' => $book['id'],
                        'isbn' => $book['isbn'],
                        'title' => $book['title'],
                        'subtitle' => $book['subtitle'],
                        'published' => $book['published'],
                        'rating' => $book['rating'],
                        'description' => $book['description'],
                        'user_id' => $book['user_id'],
                        'price' => $book['price']
                    ]);

                    $order->books()->save($book, array(
                        'book_price_at_order' => $book['price']
                    ));
                }
            }

            $ol = Orderlog::create([
                'state' => $order['state'],
                'comment' => $order['comment'],
                'order_id' => $order['id']
            ]);


            $order->orderLogs()->save($ol);


            DB::commit();
            // return a vaild http response
            return response()->json($order, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request): Request
    {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }


    public function updateState(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $order = Order::with(['books', 'user'])
                ->where('id', $id)
                ->first();
            if ($order != null) {
                $request = $this->parseRequest($request);
                $order->update($request->all());

                $order->save();

            }

            $ol = Orderlog::create([
                'state' => $order['state'],
                'comment' => $order['comment'],
                'order_id' => $order['id']
            ]);


            $order->orderLogs()->save($ol);
            DB::commit();
            $order1 = Book::with(['books', 'user'])
                ->where('id', $id)
                ->first();
            // return a vaild http response
            return response()->json($order1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating order failed: " . $e->getMessage(), 420);

        }
    }


}

//
//namespace App\Http\Controllers;
//
//use App\Order;
//use App\Book;
//use App\User;
//use App\Orderlog;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Http\JsonResponse;
//
//
//class OrderController extends Controller
//{
//    //liefert die Liste aller Bücher zurück
//    public function index()
//    {
//
//        /**
//         * load all books and relations with eager loading
//         * lazy loading: ich bekomme die Daten von den Büchern, aber nicht den Autoren, die müssen nachgeladen werden
//         * eager loading: alles soll gleich mitgeladen werden (Authoren, Bilder,...)
//         */
//        $orders = Order::with(['user', 'books', 'orderlogs'])->get();
//        return $orders;
//
//    }
//
//    public function save(Request $request): JsonResponse
//    {
//
//
//        DB::beginTransaction();
//
//        try {
//            $order = Order::create($request->all());
//
//
//            // save books
//            if (isset($request['books']) && is_array($request['books'])) {
//                foreach ($request['books'] as $book) {
//                    $book = Book::firstOrNew([
//                        'id' => $book['id'],
//                        'isbn' => $book['isbn'],
//                        'title' => $book['title'],
//                        'subtitle' => $book['subtitle'],
//                        'published' => $book['published'],
//                        'rating' => $book['rating'],
//                        'description' => $book['description'],
//                        'user_id' => $book['user_id'],
//                        'price' => $book['price']
//
//                    ]);
//                    $order->books()->save($book);
//                }
//            }
//
//            $ol = Orderlog::create([
//                'state' => $order['state'],
//                'comment' => $order['comment'],
//                'order_id' => $order['id']
//            ]);
//
//
//            $order->orderLogs()->save($ol);
//
//
//            DB::commit();
//            // return a vaild http response
//            return response()->json($order, 201);
//        } catch (\Exception $e) {
//            // rollback all queries
//            DB::rollBack();
//            return response()->json("saving book failed: " . $e->getMessage(), 420);
//        }
//    }
//
//    private function parseRequest(Request $request): Request
//    {
//        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
//        $date = new \DateTime($request->published);
//        $request['published'] = $date;
//        return $request;
//    }
//
//    public function updateState(Request $request, string $id): JsonResponse
//    {
//        DB::beginTransaction();
//        try {
//            $order = Order::with(['books', 'user'])
//                ->where('id', $id)->first();
//            if ($order != null) {
//                $request = $this->parseRequest($request);
//                $order->update($request->all());
//                $order->save();
//
//            }
//
//            $ol = Orderlog::create([
//                'state' => $order['state'],
//                'comment' => $order['comment'],
//                'order_id' => $order['id']
//            ]);
//
//
//            $order->orderLogs()->save($ol);
//
//
//            DB::commit();
//            $order1 = Order::with(['books', 'user'])
//                ->where('id', $id)->first();
//            // return a vaild http response
//            return response()->json($order1, 201);
//        } catch (\Exception $e) {
//            // rollback all queries
//            DB::rollBack();
//            return response()->json("Orderstatus ändern fehlgeschlagen: " . $e->getMessage(), 420);
//
//        }
//    }
//
//
//}