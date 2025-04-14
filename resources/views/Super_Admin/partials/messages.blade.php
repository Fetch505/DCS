@if(Session::has('success'))

	<div class="alert alert-success" role="alert" id="myAlertSuccess">
		<strong>Success:</strong>
		{{ Session::get('success') }}
	</div>

@endif



@if(count($errors) > 0)

	<div class="alert alert-danger" role="alert" id="myAlertDanger">
		<strong>Errors:</strong>
		<ul>
			@foreach($errors->all() as $error)
				<li> {{ $error }} </li>
			@endforeach
		</ul>
	</div>

@endif
<div class="flash-message" id="myAlert">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
    @endif
  @endforeach
</div>

<script type="text/javascript">

	$(document).ready(function() {

		setTimeout(function(){
			$('#myAlertSuccess').hide('fade');
		}, 5000);

		setTimeout(function(){
			$('#myAlertDanger').hide('fade');
		}, 5000);


	});

</script>
