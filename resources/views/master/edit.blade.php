<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow p-8">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

        <form action="{{ route('master.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
    
            <div class="flex items-center justify-between">
                <a href="{{ route('master.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kembali</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update User</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>