@if(session('guardado'))
	<div class="alert alert-success" style="padding-top: 1%" role="alert">
	  <h6>{{ session('guardado') }}</h6>
	</div>
@endif