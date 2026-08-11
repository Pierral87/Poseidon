<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Nouveau livre</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf

                        {{-- Champ Titre --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre du livre</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" 
                                   placeholder="Ex: Le Comte de Monte-Cristo"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Champ Auteur (Menu déroulant) --}}
                        <div class="mb-3">
                            <label for="author_id" class="form-label">Auteur</label>
                            <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un auteur --</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success">Enregistrer le livre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>