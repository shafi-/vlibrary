<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<style>
	table {
		width: 100%;
		 border-collapse: collapse;
		 background-color: #ffe5e5;
	}
	td {
		text-align: center;
	}
	table, tr {
  		 border: 1px solid black;
	}
	th {
	    background-color: #4CAF50;
	    color: white;
	}
	tr:hover{background-color:#00ffbf}
</style>

<script>

	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

	function onSuccess(data, status, xhr)
	{
		// with our success handler, we're just logging the data...
		console.log(data, status, xhr);
		// but you can do something with it if you like - the JSON is deserialised into an object
		console.log(String(data.value).toUpperCase());
	//	$("#div1").text("value form ajax: " + String(data.value));

	}
	$(document).ready(function() {
	    $("button").click(function(event) {
	     //   alert(event.target.id);
    });
	$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {payload:'hello'}, onSuccess);
});
</script>
</head>
<body>
<div class="container">
	<h1>in test page</h1>

	<?php




	//	var_dump($name);
//	var_dump($bookInformation);
//	var_dump($bookInformation[0]->bookName);
//	var_dump($bookInformation->bookName);
//	echo $name;	
  	
    echo "<br> <br>";

    $bookName = $bookInformation[0]->bookName;
    $ownedBookListId = $bookInformation[0]->ownedBookListId;
    
 //   $ownBookListId = 1;
    $edition = $bookInformation[0]->edition;
    
    $publishers = $bookInformation[0]->publishers;
     $publishingYear = $bookInformation[0]->publishingYear;
    

    $authorName = "";
    $categoryName = "";

    
    for ($i = 0; $i < count($authorInformation); $i++) {
    //	echo 'in loop loop';
    	$authorName .= 'Author: ' . $authorInformation[$i]->authorName . '<br>';
    }

    for ($i = 0; $i < count($categoryInformation); $i++) {
    //	echo 'in loop loop';
    	$categoryName .= 'Category: ' . $categoryInformation[$i]->categoryName . '<br>';
    }
    // echo $authorName;
    echo $categoryName;

    //var_dump($name[0]);

  //  echo ($name[0]->BOOKID);


	?>

	<h2>Vlibrary search result</h2>
  
	<meta name="csrf-token" content="<?php echo csrf_token() ?>" />
 

  	
  	
           
	  <table class="table table-bordered" >
	    <thead>
	      <tr>
	        <th>Name</th>
	        <th>Authors</th>
	        <th>Edition</th>
	        <th>Category</th>
	        <th>Year</th>
	        
	        <th>Locations</th>
	        
	        <th>Owner </th>
	        <th>Contack No</th>
	        

	                
	        <th>Availabilty</th>	        
	       
	        <th>Publishers</th>
	        <th>Details</th>
	        
		   </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>John</td>
		        <td>Doe</td>
		        <td>john</td>
		        <td>John</td>
		        <td>Doe</td>
		        <td>john</td>
		        <td>John</td>
		        <td>Doe</td>
		        <td>john</td>
		         <td>Doe</td>
		         <td><button>Details</button></td>


		      </tr>
		      @foreach($userInformation as $user)

			      <tr>
			        <td>{{ $bookName }}</td>
			        <td>{!! $authorName !!}</td>
			        <td>{{ $edition }}</td>
			        <td>{!! $categoryName !!}</td>
			        <td>{{ $publishingYear }}</td>
			        <td>Doe</td>
			        <td>{{ $user->userFullName }}</td>
			        <td>{!! $user->phoneNo . '<br>' . $user->mobileNo !!}</td>
			        <td>{{ $user->isAvailable }}</td>
			        <td>{{ $publishers }}</td>
			        <td><button id="{{$user->ownedBookListId}}">Details</button></td>
			        
			      </tr>
		      @endforeach
		    </tbody>
		  </table>



		  <br><br><br>

	    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="modal-title">Modal Header</h6>
		      </div>
		      <div class="modal-body">
		        <p>This message will be sent to : </p>
		        <blockquote >
		        	Hi i am .... and i would like to borrow this book from you				
				</blockquote>
				<button id="sendMessage">Send Messege</button>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>




		  	
  </div>
</body>
</html>










<!-- ['bookInformation' => $bookInformation, 
                                'authorInformation' =>$authorInformation,
                    'categoryInformation' => $categoryInformation, 
                    'userInformation' => $userInformation, 
                    'bookLocationInformation' => $bookLocationInformation
                     ]); -->