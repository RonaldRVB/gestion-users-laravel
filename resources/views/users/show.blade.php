
{{-- resources/views/users/show.blade.php --}}

<x-app-layout>
    <div class="container mx-auto py-8 text-gray-800 dark:text-gray-200">
        <h1 class="text-2xl font-bold mb-6 dark:text-gray-200">Détails de l'utilisateur</h1>

        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                <p><strong>Email :</strong> {{ $user->email }}</p>
                <p><strong>Rôle :</strong> {{ $user->role }}</p>
                {{-- Ajoutez d'autres informations de l'utilisateur si nécessaire --}}
            </div>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Retour à la liste des utilisateurs</a>
    </div>
</x-app-layout>
