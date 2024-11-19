
    <x-adminlte-modal id="modalEmail" title="{{ __('Email') }}" theme="secondary" icon="fas fa-envelope" size='lg' disable-animations>
        <form action="{{ route('sendusermail') }}" method="POST">
            @csrf
            <x-adminlte-input name="recipient" label="recipient" id="recipient" placeholder="{{ __('Email') }}" label-class="text-grey">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-grey"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="title" label="title" placeholder="{{ __('Title') }}" label-class="text-grey">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-grey"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <div class="form-group">
                <div class="card p-4">
                    <label for="description"> {{ __('Text') }}</label>
                    <textarea id="summernote" class="summernote form-control" rows="14"
                        name="description">  </textarea>
                </div>
            </div>
            <x-adminlte-button type="Submit" label="{{ __('Send') }}" theme="secondary" icon="fas fa-envelope" />
        </form> 
    </x-adminlte-modal>

