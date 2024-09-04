 
@if ($phone)
    <a href="https://t.me/+34{{ $phone }}" target="_blank" rel="noreferrer" class="btn btn-sm bg-info" >
        <i class="fab fa-telegram-plane"></i> 
        {{ $phone }}
    </a>  
@endif