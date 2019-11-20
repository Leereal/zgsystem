@if (count($errors)>0)
	@foreach($errors->all() as $error)
	<div class="alert alert-error alert-dismissible fade in text-center">
	  <strong>{{$error}}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endforeach
@endif

{{-- @if ($success->count()>0)
	@foreach($success->all() as $suc)
	<div class="alert alert-error alert-dismissible fade in text-center">
	  <strong>{{$cus}}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endforeach
@endif
 --}}

@if(session('success'))
	<div class="alert alert-success alert-dismissible fade in text-center">
	  <strong>{{session('success')}}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif

@if(session('error'))
	<div class="alert alert-error alert-dismissible fade in text-center">
	  <strong>{{session('error')}}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif


