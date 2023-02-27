<div class="row mb-3">
    <div class="col-md-4 col-form-label text-md-end">
        <label for="{{ $name }}">
            {{ ucwords($label ?? $name) }}
        </label>
    </div>
    <div class="col-md-6">
        <select 
            id="{{ $name }}" 
            name="{{ $name }}" 
            class="form-select" 
        >
            <option value="">None</option>
           
            
            @foreach ($list as $item)
            <option 
                value="{{ $item->id }}" 
                {{ $item->id == $value ? "selected" : "" }}          
            >
                {{ $item->name }}
            </option>
            @endforeach

        </select>

        @error($name)
        <span class="invalid-feedback d-block " role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>