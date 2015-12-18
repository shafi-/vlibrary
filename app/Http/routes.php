<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
})->middleware('guest');

// Task Routes
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//adding new books to library

// Route::get('addbook', function() {

// 	return view ('book.addbook');
// });
Route::get('addbook', 'Book\BookController@showAddBookPage');
Route::post('addbook', 'Book\BookController@store');

Route::get('searchbook', 'Book\SearchBookController@showSearchBookPage');
Route::post('searchbook', 'Book\SearchBookController@store');

Route::get('searchbookresult', 'Book\SearchBookResultController@showSearchBookResultPage');
Route::post('searchbookresult', 'Book\SearchBookResultController@store');





Route::get('test', 'TestController@index');
Route::post('test', 'TestController@postIndex');



Route::get('user/userhomepage', 'user\UserHomePageController@index');	



Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );


    for ($a = 0; $a < 5; $a++) {

    	$name = "alamin from laravel: " . $a;

	    Mail::send('emails.welcome', $data, function ($message) {

	        $message->from('mdabdullahalalamint@gmail.com', 'email from laravel');

	        $message->to('shafi.cse.buet@gmail.com')->subject('testing email from laravel');

	    });

	}

   

    return "Your email has been sent successfully";

});






Route::get('/ajax/view', function () {

	// really all this should be set up as a view, but I'm showing it here as
	// inline html just to be easy to drop into your routes file and test
	?>

		<!-- jquery library -->
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

		<!-- pass through the CSRF (cross-site request forgery) token -->
		<meta name="csrf-token" content="<?php echo csrf_token() ?>" />

		<!-- some test buttons -->
		<button id="get">Get data</button>
		<button id="post">Post data</button>
		<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>

		<!-- your custom code -->
		<script>
			// set up jQuery with the CSRF token, or else post routes will fail
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			// handlers
			function onGetClick(event)
			{
				// we're not passing any data with the get route, though you can if you want
				$.get('http://localhost/laravel/vlibrary/public/index.php/ajax/get', onSuccess);
			}
			function onPostClick(event)
			{
				// we're passing data with the post route, as this is more normal
				$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {payload:'hello'}, onSuccess);
			}
			function onSuccess(data, status, xhr)
			{
				// with our success handler, we're just logging the data...
				console.log(data, status, xhr);
				// but you can do something with it if you like - the JSON is deserialised into an object
				console.log(String(data.value).toUpperCase());
				$("#div1").text("value form ajax: " + String(data.value));

			}
			// listeners
			$('button#get').on('click', onGetClick);
			$('button#post').on('click', onPostClick);
		</script>

	<?php
});


// this is your GET AJAX route
Route::get('/ajax/get', function () {
	// pass back some data
	$data   = array('value' => 'some data');
	// return a JSON response
	return  Response::json($data);
});
// this is your POST AJAX route
Route::post('/ajax/post', function () {
	// pass back some data, along with the original data, just to prove it was received
	$data   = array('value' => 'some data returning', 'input' => Request::input());
	// return a JSON response
	return  Response::json($data);
});