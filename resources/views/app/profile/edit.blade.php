@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1 class="text-center">Edit your Profile</h1>
				{!! Form::open(['files' => 'true', 'id' => 'FormCoverProfile']) !!}
					<h3>Cover Image</h3>
					<img src="{{ $user->getCoverImagePath() }}" class="img-responsive">
					<p><small>Your cover image will be cropped to fit 1300x400</small></p>
					<div class="alert alert-danger" id="CoverError" style="display: none" role="alert"></div>
					<p class="text-center">
	  					<label for="file-upload-cover" class="pointer">
						    <i class="fa fa-cloud-upload"></i> Change Cover Image
						</label>
						<input id="file-upload-cover" name="image" type="file" style="display: none;" />
					</p>
					<div class="progress" style="display: none">
						<div id="CoverProgressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
						</div>
					</div>
				{!! Form::close() !!}
				{!! Form::open(['files' => 'true', 'id' => 'FormProfile']) !!}
					<h3>Profile Image</h3>
					<img src="{{ $user->getAvatarImagePath() }}" class="img-responsive">
					<p><small>Your cover image will be cropped to fit 500x500</small></p>
					<div class="alert alert-danger" id="ProfileError" style="display: none" role="alert"></div>
					<p class="text-center">
	  					<label for="file-upload-profile" class="pointer">
						    <i class="fa fa-cloud-upload"></i> Change Profile Picture
						</label>
						<input id="file-upload-profile" name="image" type="file" style="display: none;" />
					</p>
					<div class="progress" style="display: none">
						<div id="ProfileProgressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('scripts')

<script type="text/javascript">
	
	$(document).ready(function(){

		var redirectTo = "{{ route('profile.view', ['id' => $user->id]) }}";

		$(document).on('change','#file-upload-cover' , function(){
			
			$form = $('#FormCoverProfile');
			var formData = new FormData($form[0]);
			var url = "{{ route('profile.changeCover') }}";
			var progressBar = 'CoverProgressBar';
			var errorStatus = 'CoverError';

			uploadFile(formData, url, progressBar, errorStatus);

		});

		$(document).on('change','#file-upload-profile' , function(){
			
			$form = $('#FormProfile');
			var formData = new FormData($form[0]);
			var url = "{{ route('profile.changeProfile') }}";
			var progressBar = 'ProfileProgressBar';
			var errorStatus = 'ProfileError';

			uploadFile(formData, url, progressBar, errorStatus);

		});

		function uploadFile(formData, url, progressBar, errorStatus){

			var request = new XMLHttpRequest();

			request.upload.addEventListener('progress', function(e){

				var percent = e.loaded/e.total * 100;
				$('#' + progressBar).parent().show();
				$('#' + progressBar).css('width', percent+'%').attr('aria-valuenow', percent);	

			});

			request.onreadystatechange = function() {
			    if (request.readyState == XMLHttpRequest.DONE) {
			    	var data = JSON.parse(request.responseText);
			        if (data.success){
			        	window.location.replace(redirectTo);
			        } else {
			        	$("#" + errorStatus).show();
			        	$("#" + errorStatus).html(data.errors.image);
			        }
			    }
			}

			request.open('post', url);
			request.setRequestHeader("X-CSRF-TOKEN", '{{ Session::token() }}');
			request.send(formData);
		}

	});

</script>

@endsection