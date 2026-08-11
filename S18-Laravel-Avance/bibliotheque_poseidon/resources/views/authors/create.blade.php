<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Nouveau Auteur</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('authors.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            {{-- Prénom --}}
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Prénom</label>
                                <input type="text" 
                                       name="first_name" 
                                       id="first_name" 
                                       class="form-control @error('first_name') is-invalid @enderror" 
                                       value="{{ old('first_name') }}" 
                                       required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nom --}}
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Nom</label>
                                <input type="text" 
                                       name="last_name" 
                                       id="last_name" 
                                       class="form-control @error('last_name') is-invalid @enderror" 
                                       value="{{ old('last_name') }}" 
                                       required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Téléphone --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone (optionnel)</label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success">Enregistrer l'auteur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>