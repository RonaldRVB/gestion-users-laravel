<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Liste des Utilisateurs</h1>

        <form action="{{ route('users.index') }}" method="GET" class="text-center mb-4">
            <input type="text" name="search" placeholder="Rechercher par nom ou email" value="{{ request()->input('search') }}" class="border border-gray-300 px-3 py-2">
            <button type="submit" class="btn btn-primary dark:text-gray-200">Rechercher</button>
        </form>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Rôle</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('users.show', $user->id) }}" class="btn text-blue-500">Voir</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn text-yellow-500 ml-2">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>