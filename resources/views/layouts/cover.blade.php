<div class="col-md-8 col-md-offset-2 cover">
	<div class="fb-profile">
        <img align="left" class="fb-image-lg" src="{{ $user->getCoverImagePath() }}">
        <a href="{{ $user->getAvatarImagePath() }}" data-lightbox="profilePhoto" data-title='Profile Picture'><img align="left" class="fb-image-profile thumbnail" style="width:115px" src="{{ $user->getAvatarImagePath() }}"/></a>
          
        <div class="fb-profile-text">
          	<h2 class="pull-left">{{ $user->getFullName() }} @if ($user->id == Auth::user()->id) <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a> @endif</h2>
            <ul class="nav nav-pills pull-right">
				<li role="presentation" @if ($active == 'timeline') class="active" @endif><a href="{{ route('profile.view', ['id' => $user->id]) }}"><i class="fa fa-lg fa-bars" aria-hidden="true"></i> Timeline</a></li>
				<li role="presentation" @if ($active == 'photos') class="active" @endif><a href="{{ route('photos', ['id' => $user->id]) }}"><i class="fa fa-lg fa-picture-o" aria-hidden="true"></i> Photos</a></li>
				<li role="presentation" @if ($active == 'friends') class="active" @endif><a href="{{ route('friends', ['id' => $user->id]) }}"><i class="fa fa-lg fa-users" aria-hidden="true"></i> Friends</a></li>
			</ul>
        </div>
    </div>
</div>

<div class="clearfix"></div>