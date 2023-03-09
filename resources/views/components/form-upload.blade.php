@props(['id', 'type' => 'file', 'name', 'placeholder' => '', 'required' => true])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" {{
    $attributes->merge(['class' => 'form-control']) }} {{ $attributes->get('wire') }} @if($required) required @endif />
