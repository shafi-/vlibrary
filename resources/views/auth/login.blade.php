@extends('layouts.app')

@section('content')
	<div class="container">

 	     <?php
            //    echo "from php about to var dump";
            //     $a = ["alamin", "is ", "awesome"];
            // echo '<pre>' ;
            //  var_dump($a);
            //  echo '</pre>'; 
 	       $url = ($_SERVER["REQUEST_URI"]);
           echo  ($url);
           echo "<br>";
           $actualUrl = $url;
           if (strpos($url, "auth/login")) {
           	  echo "...Dont ... need to add <br>";
           } else {
           	  $url = $url + "\auth\login";
           	  echo "add it manually <br>";
           }
           echo "final url: " . $url . "<br>";
        //   echo  ($_SERVER['HTTP_HOST']);
 	   //     echo "print $serverurl: " . $_SERVER["REQUEST_URI"] . "<br>";
                        
        ?>
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Login
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Task Form -->
					<form action="" method="POST" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">EMail</label>

							<div class="col-sm-6">
								<input type="email" name="email" class="form-control" value="{{ old('email') }}">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Password</label>

							<div class="col-sm-6">
								<input type="password" name="password" class="form-control">
							</div>
						</div>

						<!-- Login Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-sign-in"></i>Login
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
