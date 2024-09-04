@php
    $options = [];
    foreach ($degrees as $degree) {
        $options[$degree->id] = $degree->name;
    }
@endphp
<x-adminlte-select id="degree" name="degree" label="{{ __('Degree') }}" label-class="text-lightblue">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-lg fa-certificate text-lightblue"></i>
        </div>
    </x-slot>

    <x-adminlte-options :options="$options" :selected="$selected"
        empty-option="{{ __('Select an option...') }}" />
</x-adminlte-select>