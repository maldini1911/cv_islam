@if(Session::has('error'))
<div class="text-center">
      <h4 class="alert alert-danger"> {{Session::get('error')}}</h4>
</div>
@endif
