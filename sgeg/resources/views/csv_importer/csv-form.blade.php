<h2>  CSV import users </h2>
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    <h3>{{ __('Import CSV') }}</h3>
    @csrf
    <input type="file" name="document_csv">
    <input type="submit" value="Import csv">
</form>