<?php

namespace App\Model;
use DB;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	
    //
	public static function addToBookInfo($BookName, $Publishers, $Price, $PageNumbers, 
		$Language , $PublishingYear) {

		DB::insert ('INSERT INTO bookinfo (BookName, Publishers, PublishingYear, PageNumbers, Price, Language) ' .
    //    'VALUES ($BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language');
        ' VALUES (?, ?, ?, ?, ?, ?)', [$BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language]);
      //  'VALUES ($BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language');

	
        \Log::info ("book has been successfully added to book info db");
    //    $BookId = Book::getBookId($BookName);
        Book::getBookId($BookName);
    //    Book::getBookId("alamin");
   //      \Log::info ($BookId);
     //    \Log::info ("method book_id calling over");
         
      
	//	DB::insert ('  INSERT INTO bookinfo (BookName,  PublishingYear) ' .
        //    ' values (?, ? )', [$BookName, $PublishingYear]);
    }



//
    public static function addToAuthors($AuthorName) {
    	\Log::info ("in addtoauthors method");
    //   \Log::info ($AuthorName);
    	foreach ($AuthorName as $author) {
           		if (strlen($author) > 0) {
    				\Log::info ($author);

    				DB::insert ('INSERT INTO authors (AuthorName) ' .
       				' VALUES (?)', [$author]);

       			//	Book::getAuthorId($author);  

           		}      	
                       
          }
	
	
    }

   public static function addToBookInfoAuthors($BookName, $AuthorName) {
    	\Log::info ("in addToBookInfoAuthors method");
    //   \Log::info ($AuthorName);
    	$BookId = Book::getBookId($BookName);
    	foreach ($AuthorName as $author) {
           		if (strlen($author) > 0) {
    			//	\Log::info ($author);    				
       				$AuthorId = Book::getAuthorId($author); 

					 \Log::info ("AuthorId");       				
       				 \Log::info ($AuthorId);
       				  \Log::info ($BookId);
    				\Log::info ("BookId");

    				DB::insert ('INSERT INTO bookinfoauthors (BookId, AuthorId) ' .
       				' VALUES (?, ?)', [$BookId, $AuthorId]);

           		}      	
                       
          }
	
	
    }





    public static function getBookId($BookName) {

    	 $BookId = DB::select(

    	   ' select BookId ' .
           ' from bookinfo  ' .
           ' where  BookName = ?; ', [$BookName]);
    //	 \Log::info ($BookId);
    //	 $temp = 5;
    	  // foreach ($BookId as $user) {
                    
       //               //    echo  '<li class="list-group-item">' .$user->empname . " ...............  " 
       //              //    ."</li>";

       //                   $temp = $user->BookId;
       //                   break;
                        
       //    }

          $temp = $BookId[0]->BookId;
    	 \Log::info ($temp);
    	 return $temp;

    	 \Log::info ("in the function bookName");
        

           


    }



    public static function getAuthorId($AuthorName) {

    	 $BookId = DB::select(

    	   ' select AuthorId ' .
           ' from authors  ' .
           ' where  AuthorName = ?; ', [$AuthorName]);
    //	 \Log::info ($BookId);
    //	 $temp = 5;
    	  // foreach ($BookId as $user) {
                    
       //               //    echo  '<li class="list-group-item">' .$user->empname . " ...............  " 
       //              //    ."</li>";

       //                   $temp = $user->BookId;
       //                   break;
                        
       //    }

          $temp = $BookId[0]->AuthorId;
    	 \Log::info ($temp);
    	 return $temp;

    	 \Log::info ("in the function authorName");           


    }



	public static function getCategory() {

    	 $CategoryName = DB::select(

    	   ' select CategoryName ' .
           ' from category ; ') ;
          return $CategoryName;

    }

    public static function getLocations() {

    	 $LocationName = DB::select(

    	   ' select LocationName ' .
           ' from Locations ; ') ;
          return $LocationName;

    }

    






	

}
