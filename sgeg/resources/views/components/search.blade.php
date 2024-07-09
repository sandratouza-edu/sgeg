<div class="search">
    <form method="POST" action="{{ route('search') }}">
        @csrf
        <input type="text" placeholder="Buscar" name="name" value="{{ old('name') }}">
        <input type="submit">
    </form>
</div>
