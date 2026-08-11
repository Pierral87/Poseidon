<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Détails du livre</h1>
            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">Retour à la liste</a>
        </div>
        <div class="card-body">
            <h2 class="card-title text-primary">{{ $book->title }}</h2>
            
            <p class="card-text mt-3 fs-5">
                <strong>Auteur :</strong> 
                {{ $book->author->last_name ?? 'Auteur inconnu' }}
            </p>

            <hr>

            <div class="d-flex gap-2">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Modifier</a>

                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Supprimer ce livre ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>