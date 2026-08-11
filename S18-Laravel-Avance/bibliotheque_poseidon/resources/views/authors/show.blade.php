<div class="container my-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Fiche Auteur</h1>
            <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary btn-sm">Retour à la liste</a>
        </div>
        <div class="card-body">
            <h2 class="card-title text-primary">{{ $author->last_name . " " . $author->first_name }}</h2>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Email :</strong> <a href="mailto:{{ $author->email }}">{{ $author->email }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Téléphone :</strong> {{ $author->phone ?? 'Non renseigné' }}</p>
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">Modifier</a>

                <form action="{{ route('authors.destroy', $author) }}" method="POST" onsubmit="return confirm('Supprimer cet auteur ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Liste des livres écrits par cet auteur --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h3 class="h5 mb-0">Livres publiés ({{ $author->books->count() }})</h3>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse($author->books as $book)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none font-weight-bold">
                            {{ $book->title }}
                        </a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-secondary">Éditer le livre</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted py-3 text-center">
                        Cet auteur n'a encore aucun livre enregistré.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>