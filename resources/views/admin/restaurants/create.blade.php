@extends('layouts.admin')
@section('content')
<section class="container my-5" id="create-restaurant">
        <div class="row bg-white p-4" id="form">
    <h1 class="mb-4">Crea il tuo ristorante</h1>

            <div class="col-12">
                <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="form-crud">
                    @csrf
                    {{-- Nome Ristorante --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome<span>*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required maxlength="100" minlength="3" value="{{old('name')}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">* Minimo 3 caratteri e massimo 100 caratteri</div>
                    </div>
                    {{-- Email Ristorante --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span>*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required maxlength="100" minlength="3" value="{{old('email')}}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Partita iva Ristorante --}}
                    <div class="mb-3">
                        <label for="p_iva" class="form-label">Partita IVA <span>*</span></label>
                        <input type="text" name="p_iva" id="p_iva" class="form-control  @error('p_iva') is-invalid @enderror" required maxlength="13" minlength="13" value="{{old('p_iva')}}">
                        @error('p_iva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">* Formato es. IT55555555555</div>
                    </div>
                    {{-- Indirizzo Ristorante --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo <span>*</span></label>
                        <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror" required maxlength="255" minlength="3" value="{{old('address')}}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">* Via, CAP, Città e Provincia</div>
                    </div>
                    {{-- Numero di telefono del Ristorante --}}
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numero di Telefono <span>*</span></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control  @error('phone_number') is-invalid @enderror" required maxlength="10" minlength="10" value="{{old('phone_number')}}">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Orari di apertura --}}
                    <div class="mb-3 d-flex align-items-start">
                        <div class="me-4">
                            <label for="opening_hours" class="form-label">Orario di apertura <span>*</span></label>
                            <input type="time" name="opening_hours" id="opening_hours" class="form-control  @error('opening_hours') is-invalid @enderror" required value="{{old('opening_hours')}}">
                            @error('opening_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="closing_hours" class="form-label">Orario di chiusura <span>*</span></label>
                            <input type="time" name="closing_hours" id="closing_hours" class="form-control  @error('closing_hours') is-invalid @enderror" required value="{{old('closing_hours')}}">
                            @error('closing_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Tipo di  Ristorante --}}
                    <div class="mb-3 row">
                    <label for="types" class="form-label">Tipo <span>*</span></label>
                        @foreach ($types as $type)
                            @if (old("types"))
                            <div class="d-flex col-xxl-2 col-lg-3 col-md-4 col-6">
                                <input class="me-2" type="checkbox" name="types[]" value="{{ $type->id }}" {{in_array( $type->id, old("types", []) ) ? 'checked' : ''}}>
                                <span class="text-capitalize">{{ $type->name }}</span>
                            </div>
                            @else
                                <div class="d-flex col-xxl-2 col-lg-3 col-md-4 col-6">
                                    <input class="me-2" type="checkbox" name="types[]" value="{{ $type->id }} " {{ old('types') ? (old('types')->contains($type->id) ? 'checked' : '') : '' }}>
                                    <span class="text-capitalize">{{ $type->name }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div> 
                    {{-- Sito web del Ristorante --}}
                    <div class="mb-3">
                        <label for="website" class="form-label">Sito web</label>
                        <input type="text" name="website" id="website" class="form-control  @error('website') is-invalid @enderror" value="{{old('website')}}">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Immagine Ristorante --}}
                    <div class="mb-3">
                        <img id="uploadPreview" class="mb-2" width="100" src="https://via.placeholder.com/300x200">
                        <label for="image" class="form-label">Immagine</label>
                        <input type="file" name="image" id="create_cover_image" class="form-control  @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 mt-1">*campi obbligatori</div>
                    <button type="submit" class="btn btn-primary">Inserisci</button>
                    <button type="reset" id="reset" class="btn btn-danger text-white">Resetta</button>
                </form>
            </div>
        </div>
    </section>
@endsection