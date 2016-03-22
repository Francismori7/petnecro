<fieldset class="form-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    {{ Form::label($name, $label ?: null, []) }}
    {{ Form::password($name, array_merge(['class' => 'form-control' . ($errors->has($name) ? ' form-control-danger' : '')], $attributes)) }}
    @if($errors->has($name))
        <span class="text-danger">
            {{ $errors->first($name) }}
        </span>
    @endif
</fieldset>