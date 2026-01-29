<form action="{{ isset($crud) ? route('api_crud.update', $crud->id) : route('api_crud.store') }}" method="POST">
    @csrf
    @if(isset($crud))
        @method('PUT')
    @endif

    <div>
        <label>Name <span class="required-star">*</span></label>
        <input type="text" name="name"
               value="{{ old('name', $crud->name ?? '') }}"
               placeholder="Name"
               class="form-control @error('name') is-invalid @enderror">

        @error('name')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Email <span class="required-star">*</span></label>
        <input type="text" name="email"
               value="{{ old('email', $crud->email ?? '') }}"
               placeholder="Email"
               class="form-control @error('email') is-invalid @enderror">

        @error('email')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <div style="text-align:center;">
        <button type="submit"
                class="btn-small {{ isset($crud) ? 'btn-primary' : 'btn-success' }}">
            {{ isset($crud) ? 'Update' : 'Add' }}
        </button>
    </div>
</form>
