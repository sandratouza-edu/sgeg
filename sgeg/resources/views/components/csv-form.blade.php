<div>
<table><tr><td style="border-bottom:0">
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="document_csv">
        <input type="submit" value="Import csv">
    </form>
</td><td style="border-bottom:0">
    <h4> <a class="link-button" href="{{ route('export') }}"> Exportar</a></h4>
</td></tr></table>
</div>