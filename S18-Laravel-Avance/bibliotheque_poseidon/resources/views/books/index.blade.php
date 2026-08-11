<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des livres</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Ajouter un livre</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>
                                <a href="{{ route('books.show', $book) }}" class="fw-bold text-decoration-none">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td>
                                {{-- Accessor sécurisé avec optional/nullsafe au cas où l'auteur aurait été supprimé --}}
                                {{ $book->author->last_name ?? 'Auteur inconnu' }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning">Éditer</a>
                                
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression de ce livre ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Aucun livre enregistré pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>