<div class="row mb-3">
    <div class="col-md-4 col-form-label text-md-end">
        <label for="{{ $name }}">
            {{ ucwords($label ?? $name) }}
        </label>
    </div>
    <div class="col-md-6">
        <input 
            id="{{ $name }}" 
            name="{{ $name }}"  
            {{ $attributes->class(['form-control', 'is-invalid' =>  $errors->has($name)]) }} 
            {{ $attributes(['value'=>old($name)]) }} 
            autofocus
        >

        @error($name)
        <span class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>