<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des Auteurs</h1>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">Ajouter un auteur</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Nombre de livres</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>
                                <a href="{{ route('authors.show', $author) }}" class="fw-bold text-decoration-none">
                                    {{ $author->last_name . " " . $author->first_name }}
                                </a>
                            </td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->phone ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $author->books->count() }} livre(s)
                                </span>
                            </td>
                            <td class="text-end">
                            @role('admin')
                                <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-outline-warning">Éditer</a>
                            @endrole
                            @can('delete books')
                                <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression de cet auteur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun auteur enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>