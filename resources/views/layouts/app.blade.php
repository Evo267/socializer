<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<!-- Icons -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- fonts -->
		<link href="https://fonts.googleapis.com/css?family=Lato|Questrial|Just+Another+Hand" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Lightbox -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }}">

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

	</head>
	<body>

		<nav class="navbar navbar-default">
			<div class="container" style="margin-top: 10px">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ route('index') }}">{{ config('app.name', 'Laravel') }}</a>
				</div>
				<div class="collapse navbar-collapse" id="navigation">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="{{ route('profile.view', ['id' => Auth::user()->id]) }}">Profile</a></li>
						<li><a href="{{ route('index') }}">Home</a></li>
						<li><a href="{{ url('/logout') }}">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')



		<footer>
			<p>Developed By <a href="http://www.rafaelmachado.pt" target="_blank">Rafael G. Machado</a></p>
			<p>Please consider hiring me for a upcoming project of yours.</p>
		</footer>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		
		@yield('scripts')
		

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script type="text/javascript" src="{{ asset('js/lightbox.js') }}"></script>

		<script type="text/javascript">

			$(document).ready(function(){

				function updateOnlineStatus(){
					$.ajax({
						type: "POST",
						url: "{{ route('online') }}",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				}

				updateOnlineStatus();

				// update every 30 seconds

				window.setInterval(function(){
					updateOnlineStatus();
				}, 15000);

			});
			
			(function($) {

				if (!$('.followUser').length){
					return;
				}

			    var element = $('.followUser'),
			    originalY = element.offset().top;
			    
			    var topMargin = 5;
			    
			    // Should probably be set in CSS; but here just for emphasis
			    $( window ).resize(function() {
			    	if ($(window).width() < 992){
			    		element.animate({ top: 0 });
			    	} 
			   	});

			    $(window).on('scroll', function(event) {
			        var scrollTop = $(window).scrollTop();
			        if ($(window).width() >= 992){
			        	element.finish();			        
				        element.stop(false, false).animate({
				            top: scrollTop < originalY
				                    ? 0
				                    : scrollTop - originalY + topMargin
				        }, 50);
			    	} else {
			    		element.animate({ top: 0 });
			    	}
			    });
			    
			})(jQuery);

			
			

		</script>

		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
	
				hashtag_regexp = /#(([a-zA-Z0-9]+)|([\u0600-\u06FF]+))/g;

				function linkHashtags(text) {

					var url = '{{ url('/') }}';

				    return text.replace(
				        hashtag_regexp,
				        '<a class="hashtag" href="' + url + '/tag/$1">#$1</a>'
				    );
				} 

			    $('.post_content').each(function() {
			        $(this).html(linkHashtags($(this).html()));
			    });

			});
		</script>
		@include('layouts.confirm_delete')
	</body>
</html>