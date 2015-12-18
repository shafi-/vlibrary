<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use App\Model\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
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
       // \Log::info(".....about to store book in the Database ");
        //
        $BookName = $request->BookName;
        $CategoryName = $request->input('CategoryName', 'CategoryName not set');
        $AuthorName = $request->input('AuthorName', 'AuthorName not set');
        $Price  = $request->input('Price', 'Price not set') ;
        $Language = $request->input('Language', 'Language not set') ;
        $PageNumbers = $request->input('PageNumbers', 'PageNumbers not set') ;
        $PublishingYear = $request->input('PublishingYear', 'PublishingYear not set');        
        $Publishers = $request->input('Publishers', 'Publishers not set');
        $ShareType = $request->input('ShareType', 'ShareType not set') ;


        $all = $request->all();
        $arr = $request->input('CategoryName.0.name');

        \Log::info("....in book controller store method trying to extract values ");
        \Log::info($BookName);
        \Log::info($CategoryName);
        \Log::info($AuthorName);
        \Log::info($Price);
        \Log::info($Language);
        \Log::info($PageNumbers);
        \Log::info($PublishingYear);
        \Log::info($Publishers);
        \Log::info($ShareType);


     
     //   Book::addToBookInfo($request->BookName, $request->PublishingYear);
        Book::addToBookInfo($BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language);
        Book::addToAuthors($AuthorName);
        Book::addToBookInfoAuthors($BookName, $AuthorName);
        

        \Log::info('About to redirect .....');
      
        return redirect('/addbook');
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

    public function showAddBookPage()
    {
        //
     //   \Log::info("in the showAddBookPage method");  

        $CategoryName = Book::getCategory();
        $LocationName = Book::getLocations();
         \Log::info($LocationName);   

         \Log::info("category name print over");      
        return view ('book.addbook',['CategoryName' => $CategoryName, 'LocationName' => $LocationName]);
    }


}
