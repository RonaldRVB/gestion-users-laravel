<x-app-layout class=" text-gray-900 dark:text-gray-200">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 dark:text-gray-200">Modifier l'utilisateur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="text-gray-900">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label block text-sm font-bold mb-2 dark:text-gray-200">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control w-full border border-gray-300 px-3" required >
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label block text-sm font-bold mb-2 dark:text-gray-200">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control w-full border border-gray-300 px-3" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label block text-sm font-bold mb-2 dark:text-gray-200">Mot de passe (laisser vide pour ne pas modifier)</label>
                <input type="password" name="password" class="form-control w-full border border-gray-300 px-3">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label block text-sm font-bold mb-2 dark:text-gray-200">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control w-full border border-gray-300 px-3">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label block text-sm font-bold mb-2 dark:text-gray-200">Rôle</label>
                <select name="role" class="form-control border border-gray-300 px-3" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <!-- Ajoutez d'autres rôles si nécessaire -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary dark:text-gray-200 py-5">Mettre à jour l'utilisateur</button>
        </form>

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3 dark:text-gray-200">Retour à la liste des utilisateurs</a>
    </div>
</x-app-layout>
