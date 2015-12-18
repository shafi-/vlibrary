<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        

         $name = DB::select (  ' SELECT DISTINCT(BIA.BOOKID) '.
                              '  FROM BOOKINFOAUTHORS BIA, AUTHORS A  '.
                               ' WHERE (A.AUTHORID = BIA.AUTHORID) ' .
                               ' and A.AuthorName = "asdf"'  );
         

         $name2 = DB::select (  ' SELECT DISTINCT(BIC.BOOKID) 

                                    FROM BOOKINFOCATEGORY BIC, CATEGORY C
                                    WHERE (C.CATEGORYID = BIC.CATEGORYID)
                                    and C.CATEGORYNAME = "Novel" ' );

         $collection = collect($name);

   //     $intersect = $collection->intersect($name2);

   //    $name3 = $intersect->all();
         
    //     \Log::info($intersect);
         $LocationName = array("Mirpur", "Azimpur", "Rampura");
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




         // $query = 'SELECT bia.bookId FROM BOOKINFOAUTHORS bia, 
         //          Authors A where (A.authorId = Bia.authorId) ';

         // for ($i = 0; $i < count($AuthorName); $i++) {
         //    if ($i == 0) {
         //        $query .= ' and A.AuthorName = "' . $AuthorName[$i] . '"';
         //    } else {
         //        $query .= ' or A.AuthorName = "' . $AuthorName[$i]  . '"' ;
         //    }
         // }

         // $query .= ' ; ';









         // $name = $query;

         // $name = DB::select($name);

      
         //  $query = 'SELECT * FROM BOOKINFO ';
         // if (strlen($BookName) > 0) {
         //    $query .= ' where BookName like "%' . $BookName . '%"' ;
         // }
         
         // $query .= ' ; ';
       //  $name = $query;

         \Log::info($query);

    // DB::table('users')
    //         ->where('name', '=', 'John')
    //         ->orWhere(function ($query) {
    //             $query->where('votes', '>', 100)
    //                   ->where('title', '<>', 'Admin');
    //         })
    //         ->get();
    //    $name = DB::select($query);

         $book = array('book2','book3','book5');
        // $book = array('book', 'c++');
        // $name = DB::Table('bookinfo')
        //         ->select('BookName', 'bookId')                
        //         ->Where(function ($query) use($book) {
        //             for ($i = 0; $i < count($book); $i++){
        //                 $query->orwhere('bookname', 'like',  '%' . $book[$i] .'%');
        //             }      
        //          })                
        //         ->get();
        // $collection = DB::Table('bookinfo')->select('*');
        // for ($i = 0; $i < count($book); $i++) {
        //     if($i == 0) {
        //         $collection->where('bookname', 'like', '%'.$book[$i].'%');
        //     }
        //     $collection->orWhere('bookname', 'like', '%'.$book[$i].'%');
        //  }
        //  $name = $collection->get();

        $Authors = ["a", "asdf"];
        $collection = DB::Table('authors')
                      ->select('BOOKINFOAUTHORS.bookId')
                      ->join('BOOKINFOAUTHORS', 'authors.authorid', '=', 'BOOKINFOAUTHORS.authorid');
         
         for ($i = 0; $i < count($Authors); $i++) {
            if($i == 0) {
                $collection->where('AuthorName', 'like', '%' .$Authors[$i]. '%');
            }
            $collection->where('AuthorName', 'like', '%' .$Authors[$i]. '%');
           }   
     //    $collection->where('AuthorName', 'like', '%' .'asdf'. '%');
         $name = $collection->get();

      //  $name = DB::select('select * from bookinfo where BookName like ?',['book5','book2']);

        \Log::info("after intersect");

        $ownedBookListId = array(1 , 14);
        // $collection = DB::Table('ownedBookList')
        //               ->select('bookinfo.bookName', 'bookinfo.edition', 'bookinfo.publishers',
        //                 'bookinfo.Language', 'ownedBookList.isAvailable',
        //                 'authors.authorName', 'CATEGORY.CATEGORYNAME', 
        //                 'user.userFullName', 'user.phoneNo', 'user.mobileNo')
        //               ->leftjoin('BOOKINFOAUTHORS', 'ownedBookList.bookid', '=', 'BOOKINFOAUTHORS.bookid')
        //               ->leftjoin('AUTHORS','authors.authorId', '=', 'BOOKINFOAUTHORS.AUTHORID')
        //               ->join('bookinfo', 'bookinfo.bookid', '=', 'ownedBookList.bookid')
        //               ->leftjoin('BOOKINFOCATEGORY', 'BOOKINFOCATEGORY.bookId', '=', 'BOOKINFO.bookId')
        //               ->leftjoin('CATEGORY', 'BOOKINFOCATEGORY.CATEGORYID', '=', 'CATEGORY.CATEGORYID')
        //               ->join('user', 'user.Id', '=', 'ownedBookList.userId')

        //               ->where('ownedBookList.ownedBookListId', $ownedBookListId[0]);
        //  for ($i = 0; $i < count($ownedBookListId); $i++) {
        //     if($i == 0) {
        //          $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
        //     }
        //      $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
        //    }  


        $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                        'bookinfo.bookName', 'bookinfo.edition', 'bookinfo.publishers',
                        'bookinfo.Language' , 'BOOKINFO.publishingYear'
                        
                        )
                      ->join('bookinfo', 'bookinfo.bookid', '=', 'ownedBookList.bookid')
                     ->where('ownedBookList.ownedBookListId', $ownedBookListId[0]);

            
          $bookInformation = $collection->get();



        $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                         'ownedBookList.bookId',
                         
                        'authors.authorName'
                        )
                      ->join('BOOKINFOAUTHORS', 'ownedBookList.bookid', '=', 'BOOKINFOAUTHORS.bookid')
                      ->join('AUTHORS','authors.authorId', '=', 'BOOKINFOAUTHORS.AUTHORID')
                      ->where('ownedBookList.ownedBookListId', $ownedBookListId[0]);

         
          $authorInformation = $collection->get();



          $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                         'ownedBookList.bookId',
                         
                        'category.categoryName'
                        )
                      ->join('BOOKINFOCATEGORY', 'ownedBookList.bookid', '=', 'BOOKINFOCATEGORY.bookid')
                      ->join('CATEGORY', 'CATEGORY.CATEGORYID', '=', 'BOOKINFOCATEGORY.CATEGORYID')
                      ->where('ownedBookList.ownedBookListId', $ownedBookListId[0]);

                      
          
          $categoryInformation = $collection->get();



      //  $this->showDetailSearchResult($ownedBookListId) ;
     //   $name = "alamin";


           $collection = DB::Table('ownedBookList')
                  ->select( 'ownedBookList.ownedBookListId',
                   'user.id',   'ownedBookList.isAvailable', 'user.email',                 
                    'user.userFullName', 'user.phoneNo', 'user.mobileNo')
                   ->join('user', 'user.Id', '=', 'ownedBookList.userId')
                   ;
                      
            for ($i = 0; $i < count($ownedBookListId); $i++) {
            if($i == 0) {
                 $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
            }
             $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
           }  
           $userInformation = $collection->get();



           $collection = DB::Table('ownedBooklocations')
                  ->select(                    
                    'ownedBooklocations.ownedBookListId','Locations.LocationName'                                       
                   )                   
                   ->join('locations', 'locations.locationId',
                    '=', 'ownedbooklocations.locationId')
                   ->orderby('ownedBooklocations.ownedBookListId');

                      
            for ($i = 0; $i < count($ownedBookListId); $i++) {
            if($i == 0) {
                 $collection->where('ownedBooklocations.ownedBookListId', $ownedBookListId[$i]);
            }
             $collection->orwhere('ownedBooklocations.ownedBookListId', $ownedBookListId[$i]);
           }  


           $bookLocationInformation = $collection->get();




        // return view('test.testView',['name' =>array(
        //                 $bookInformation, $authorInformation,
        //                 $categoryInformation,
        //                  $userInformation, $bookLocationInformation
        //                  )]);
        return view('test.testView',['bookInformation' => $bookInformation, 
                                'authorInformation' =>$authorInformation,
                    'categoryInformation' => $categoryInformation, 
                    'userInformation' => $userInformation, 
                    'bookLocationInformation' => $bookLocationInformation
                     ]);
   
       


        //
    }


    public function showDetailSearchResult($ownedBookListId) {
        $name = array("alamin");

        return view('test.testView',['name' => $name]);
    }

     public function postIndex(Request $request)
    {
        $userName = $request->input('userName', 'userName not set');

        return 'ther user name is: ' . $userName;

         


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
}
