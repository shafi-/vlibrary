<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Book</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js">
	</script>
	<script>
		$(document).ready(function(){
		   console.log ("in search page");
		   $authorNum = 1;
		   $(".author").hide();
		   $("#author1").show();

	      

		   $(".author").focus(function(){
	        $(this).css("background-color", "#cccccc");
	    	});

		    $(".author").blur(function(){

		        $(this).css("background-color", "#ffffff");
		        console.log($(this).val());
		        console.log( "in blur function with id " + $(this).attr("id"));
		        if ($(this).attr('id') === "author" + $authorNum) {
			        if ($(this).val() != "") {
			        	console.log ("we need to append a new author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum += 1;
			        	$("#author" + $authorNum).show();


			        }
		   		}	

				if ($(this).attr('id') === ("author" + ($authorNum - 1))) {
					console.log ("trying to delete");
			        if ($(this).val() === "") {
			        	console.log ("we need to delete last author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum -= 1;
			        	$("#author" + $authorNum).hide();


			        }
		   		}	


		    });


		});
</script>

<style type="text/css">
	input {
		
		margin-bottom: 5px;
	}

</style>

</head>
<body>

<div class="container" >
  

 <!--  <?php
  		echo "trying to find out if current user is authenticated or not " . '<br>';
  		if (Auth::check()) {
  			$user = Auth::user();
  			echo "<h1>.........authencicate......</h1>" . $user->email;  
  			var_dump($user);  	
		} else {
			echo "<h1>not.............not authenticated.... </h1>";
		}
		echo "<h3>php checking over</h3>";
  ?> -->

  <h2>Search Book from the VLibrary</h2>
  <form action="" method="POST" class="form-horizontal">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <div class="form-group">
      <label for="email">Book Name</label>
      <input type="text" class="form-control" id="book" placeholder="Enter book name" name="BookName">
    </div>
    <div class="form-group">

      <label for="author">AuthorName :</label>
      <input type="text" class="form-control author" id="author1" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author2" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author3" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author4" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author5" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author6" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author7" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author8" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author9" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author10" placeholder="Enter author name" name="AuthorName[]">
    </div>

	


    <div class="form-group">
      <label for="pwd">Edition :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Book edition" name="Edition">
    </div>






     <!-- <div class="form-group">
      <label for="pwd">Category :</label> <br>
		<div class="row"> 
		     	<div class="col-sm-4" >
		     		@for ($i = 0; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}" name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			        @endfor              		  
			    </div>

			    <div class="col-sm-4" >
		     		@for ($i = 1; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}" name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			    	@endfor
			     	
			   	</div>
			     

			    <div class="col-sm-4" >		
		     		@for ($i = 2; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}" name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			    
					@endfor     
			   </div>					  
	  	</div>      
    </div> 

 -->









    <div class="form-group">
      <label for="pwd">Location :</label> <br>
		<div class="row">
		  
		    	<div class="col-sm-4" >
		     		@for ($i = 0; $i < count($LocationName); $i += 3)					   
					    <input type="checkbox" value="{{ $LocationName[$i]->LocationName }}" name="LocationName[]"> {{ $LocationName[$i]->LocationName }} <br>
			        @endfor              		  
			    </div>

			    <div class="col-sm-4" >
		     		@for ($i = 1; $i < count($LocationName); $i += 3)					   
					    <input type="checkbox" value="{{ $LocationName[$i]->LocationName }}" name="LocationName[]"> {{ $LocationName[$i]->LocationName }} <br>
			       @endfor
			     	
			   	</div>
			     

			    <div class="col-sm-4" >		
		     		@for ($i = 2; $i < count($LocationName); $i += 3)					   
					    <input type="checkbox" value="{{ $LocationName[$i]->LocationName }}" name="LocationName[]"> {{ $LocationName[$i]->LocationName }} <br>
			       
					@endfor     
			   </div>		



	  	</div>      
    </div>


   
    <br> <br>
    <button type="submit" id="submit" class="btn btn-default">Search Book</button>

  </form>
  <br> <br>
</div>

</body>
</html>
