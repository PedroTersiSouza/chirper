<x-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-4">Resultados para: "{{ $term }}"</h1>
        
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <div class="p-6 text-center text-base-content/60">
                    Nenhum chirp ou usuário encontrado com esse nome.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            <a href="/" class="btn btn-ghost btn-sm">← Voltar</a>
        </div>
    </div>
</x-layout>