<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js">
	</script>
	<script>
	$(document).ready(function(){
	    $(".mymenu").click(function(){
	    	console.log("works");
	    	$(".content").hide();
	      
	    });
	    $(".content").hide();

	     $("#ownList").click(function(){
	    	console.log("ownlist clicked");
	    	$("#ownListContent").show();
	      
	    });

      $("#wishList").click(function(){
      	console.log("wishlist clicked");
    	
    	$("#wishListContent").show();
      
   	   });

       $("#profile").click(function(){
      	console.log("profile clicked");
    	
    	$("#profileContent").show();
      
   	   });


	});
</script>
</head>
<body>

<div class="container">
	  <?php
  		echo "trying to find out if current user is authenticated or not " . '<br>';
  		if (Auth::check()) {
  			$user = Auth::user();
  			echo "<h1>.........authencicate......</h1>" . $user->email;  
  			var_dump($user);  	
		} else {
			echo "<h1>not.............not authenticated.... </h1>";
		}
		echo "<h3>php checking over</h3>";
		var_dump($ownedBookList);
  	?>





  <h2>Vlibrary</h2>
  <div class="btn-group">
    <button type="button" class="btn btn-primary mymenu" id="ownList">My Book List</button>
    <button type="button" class="btn btn-primary mymenu" id="wishList">Wish List</button>
    <button type="button" class="btn btn-primary mymenu" id="profile">Profile</button>
  </div>

  <div id="ownListContent" class="content">

  	
  	<h2>Owned Book List</h2>
           
	  <table class="table">
	    <thead>
	      <tr>
	        <th>BookName</th>
	        <th>Authors</th>
	        <th>Year</th>
	        <th>Catagory</th>
	        <th>Edition</th>
	        <th>Share</th>
	        <th>Availabilty</th>
	        <th>Locations</th>
	        <th>Language</th>
	        <th>Publishers</th>
	        <th>Price</th> 	        
			<th>Pages</th>



		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		      </tr>
		      <tr>
		        <td>Mary</td>
		        <td>Moe</td>
		        <td>mary@example.com</td>
		      </tr>
		      <tr>
		        <td>July</td>
		        <td>Dooley</td>
		        <td>july@example.com</td>
		      </tr>
		    </tbody>
		  </table>
		  	
  </div>

  <div id="wishListContent" class="content">
  	 <p>wishlist</p>
  	
  </div>

 <div id="profileContent" class="content">
  	 <p>profile</p>
  	
  </div>



</div>

</body>
</html>
