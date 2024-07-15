<div>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-adminlte-input-file name="document_csv" igroup-size="sm" placeholder="Import csv file...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div class="form-group">
            <input type="submit" value="Import csv" class="btn btn-success">
        </div>
    </form>
</div>