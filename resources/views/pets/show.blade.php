<x-layouts.app :title="__('Szczegóły zwierzaka')">
    <div class="max-w-xl mx-auto p-6 text-neutral-900 dark:bg-neutral-900 dark:text-neutral-100 rounded-xl shadow space-y-6">
        <h1 class="text-2xl font-bold">Szczegóły zwierzaka</h1>

        {{-- Szczegóły --}}
        <div class="space-y-2">
            <p><span class="font-medium">ID:</span> {{ $pet['id'] }}</p>
            <p><span class="font-medium">Nazwa:</span> {{ $pet['name'] ?? 'Brak nazwy' }}</p>
            <p><span class="font-medium">Status:</span> {{ statusLabel($pet['status']) ?? 'brak' }}</p>

            @if (!empty($pet['category']))
                <p><span class="font-medium">Kategoria:</span>
                    ID: {{ $pet['category']['id'] ?? '—' }},
                    Nazwa: {{ $pet['category']['name'] ?? '—' }}
                </p>
            @endif

            @if (!empty($pet['photoUrls']) && is_array($pet['photoUrls']))
                <div>
                    <span class="font-medium">Zdjęcia:</span>
                    <ul class="list-disc list-inside text-sm mt-1">
                        @foreach ($pet['photoUrls'] as $url)
                            <li><a href="{{ $url }}" class="text-blue-600 dark:text-blue-400 underline" target="_blank">{{ $url }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!empty($pet['tags']) && is_array($pet['tags']))
                <div>
                    <span class="font-medium">Tagi:</span>
                    <ul class="list-disc list-inside text-sm mt-1">
                        @foreach ($pet['tags'] as $tag)
                            <li>
                                ID: {{ $tag['id'] ?? '—' }},
                                Nazwa: {{ $tag['name'] ?? '—' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Akcje --}}
        <div class="flex justify-between">
            <a href="{{ route('pets.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">← Wróć do listy</a>

            <div class="flex gap-2">
                <a href="{{ route('pets.edit', $pet['id']) }}"
                   class="rounded-lg bg-yellow-500 px-4 py-2 text-sm text-white hover:bg-yellow-600">
                    Edytuj
                </a>

                <form method="POST" action="{{ route('pets.destroy', $pet['id']) }}" onsubmit="return confirm('Czy na pewno chcesz usunąć tego zwierzaka?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="rounded-lg bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600">
                        Usuń
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
