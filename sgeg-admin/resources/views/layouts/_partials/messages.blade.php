@if ($message = Session::get('success'))
    <div style="background-color:aqua"> {{ $message }} </div>
@endif
@if ($message = Session::get('danger'))
    <div style="background-color:red"> {{ $message }}</div>
@endif