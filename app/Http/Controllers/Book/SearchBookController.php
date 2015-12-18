<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use DB;
use App\Model\Book;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info ("in SearchBookController store method");
        $BookName = $request->input('BookName', 'BookName not set') ;
      
        $AuthorName = $request->input('AuthorName', 'AuthorName not set');
        $LocationName  = $request->input('LocationName', 'LocationName not set');
        $Edition =  $request->input('Edition', 'Edition not set') ;
   

        $all = $request->all();
        \Log::info($all);



          $query = 'SELECT * FROM BOOKINFO ';
         if (strlen($BookName) > 0) {
            $query .= ' where BookName like "%' . $BookName . '%"' ;
         }
         
         $query .= ' ; ';

         $resultBookId = DB::select($query);

         if (count ($AuthorName) > 0) {
             $query = "";
             $query = 'SELECT bia.bookId FROM BOOKINFOAUTHORS bia, 
                      Authors A where (A.authorId = Bia.authorId) ';

             for ($i = 0; $i < count($AuthorName); $i++) {
                if ($i == 0) {
                    $query .= ' and A.AuthorName like "%' . $AuthorName[$i] . '%"';
                } else {
                    $query .= ' or A.AuthorName like "%' . $AuthorName[$i]  . '%"' ;
                }
             }

             $query .= ' ; ';

            $resultBookId2 = DB::select($query);

        }

         $query = "";

         $query = 'SELECT obl.ownedBookListId FROM ownedbooklocations obl, 
                  Locations L where (L.locationId = obl.locationId) ';

         for ($i = 0; $i < count($LocationName); $i++) {
            if ($i == 0) {
                $query .= ' and L.LocationName = "' . $LocationName[$i] . '"';
            } else {
                $query .= ' or L.LocationName = "' . $LocationName[$i]  . '"' ;
            }
         }

         $query .= ' ; ';

         $resultOwnBookId = DB::select($query);

        
         \Log::info ("about to print resultBookId");
         \Log::info ($resultBookId);
        // \Log::info ($resultBookId2);
      //   \Log::info ($resultOwnBookId);

    
        \Log::info('About to redirect from SearchBookController now.....');
      
         return view('book.searchbookresult',['resultBookId' => $resultBookId, 'resultBookId2'=>
             $resultBookId2, 'resultOwnBookId' => $resultOwnBookId]);

       // Route

       //  return redirect('/searchbookresult');
     //     return view('test.testView',['name' => $name]);

        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showSearchBookPage() {
        $CategoryName = Book::getCategory();
        $LocationName = Book::getLocations();
       //  \Log::info($LocationName);   

    //     \Log::info("category name print over");      
        return view ('book.searchbook',['CategoryName' => $CategoryName, 'LocationName' => $LocationName]);

     //   return view('book.searchbook');
    }
}
