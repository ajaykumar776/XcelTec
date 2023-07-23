 @extends('layouts.main')
 @section('content')
 <div class="row">
     <div class="col-2"></div>
     <div class="col-8" style="margin-top:100px">
         <div class="alert alert-primary" role="alert">
             You Don't have permission to do this Action <a href="{{'/users'}}" class="alert-link">Please click here to go back</a>
         </div>
     </div>
     <div class="col-2"></div>
 </div>
 @endsection