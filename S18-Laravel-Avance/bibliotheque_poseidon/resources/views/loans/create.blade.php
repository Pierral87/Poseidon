<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Enregistrer un nouvel emprunt') }}
            </h2>
            <a href="{{ route('loans.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Retour aux emprunts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf

                    {{-- Sélection de l'emprunteur --}}
                    <div class="mb-4">
                        <x-input-label for="user_id" :value="__('Utilisateur / Emprunteur')" />
                        <select name="user_id" id="user_id" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choisir un utilisateur --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    {{-- Sélection du livre disponible --}}
                    <div class="mb-4">
                        <x-input-label for="book_id" :value="__('Livre disponible')" />
                        <select name="book_id" id="book_id" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choisir un livre disponible --</option>
                            @foreach($availableBooks as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} — {{ $book->author->full_name ?? 'Auteur inconnu' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                    </div>

                    {{-- Date d'emprunt --}}
                    <div class="mb-6">
                        <x-input-label for="borrowed_at" :value="__('Date d\'emprunt')" />
                        <x-text-input type="date" name="borrowed_at" id="borrowed_at" class="w-full mt-1" :value="old('borrowed_at', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('borrowed_at')" class="mt-2" />
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <a href="{{ route('loans.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Annuler
                        </a>
                        <x-primary-button>
                            {{ __('Valider l\'emprunt') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>