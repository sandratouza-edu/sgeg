<div>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-adminlte-input-file name="document_csv" igroup-size="sm" placeholder="{{ __('Import') }} csv ...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div class="form-group">
            <input type="submit" value="{{ __('Import') }}" class="btn btn-success">
        </div>
    </form>
</div>