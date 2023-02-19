@extends('layouts.admin')
@section('content')


<div id="form" class="d-flex bg-white">
    <div class="col-12">

        <form action="{{route('admin.dishes.store')}}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <h1 class="mb-4">Crea un nuovo piatto</h1>

              {{-- Nome piatto --}}
              <div class="mb-3">
                <label for="name" class="form-label">Nome <span>*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name" name="name" required maxlength="50" minlength="3">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">* Minimo 3 caratteri e massimo 50 caratteri</div>
              </div>

              {{-- Prezzo piatto--}}
              <div class="mb-3">
                <label for="price" class="form-label">Prezzo <span>*</span></label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" id="price" name="price" required min="0" max="999">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Ingredienti piatto--}}
              <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti <span>*</span></label>
                <textarea class="form-control  @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" >{{old('ingredients')}}</textarea>
                @error('ingredients')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Categoria Piatto --}}
              <div class="mb-3">
                <label for="category_id" class="form-label text-capitalize">Seleziona categoria <span>*</span></label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror text-capitalize" required>
                    <option value="">Seleziona categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }} class="text-capitalize">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            

              {{-- Visibilità Piatto --}}
              <div class="mb-4">
                <div><label class="form-label text-capitalize">visibilità <span>*</span></label></div>
                <div class="d-flex">
                  <div class="me-3">
                    <input type="radio" id="visible" name="visible" value="1" required checked/>
                    <label for="visible">Visibile</label>
                  </div>
                  <div>
                    <input type="radio" id="visible" name="visible" value="0" required />
                    <label for="visible">Non Visibile</label>
                  </div>
                </div>
              </div>

              {{-- Immagine piatto--}}
              <div class="mb-3">
                <img id="uploadPreview" class="mb-2" width="100" src="https://via.placeholder.com/300x200">
                <label for="create_image" class="form-label">Immagine</label>
                <input type="file" name="image" id="create_cover_image"  class="form-control  @error('image') is-invalid @enderror">
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

@endsection