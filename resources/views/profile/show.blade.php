<x-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-6">Chirps de {{ $user->name }}</h1>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @endforeach
        </div>

        <div class="mt-4">
            <a href="/" class="text-blue-500 hover:underline">← Voltar para a timeline</a>
        </div>
    </div>
</x-layout>