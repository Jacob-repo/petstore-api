<x-layouts.app :title="__('Lista zwierzaków')">
    <div class="flex flex-col gap-6 p-6" style="overflow-y: scroll">

        {{-- Główne akcje --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <form method="GET" action="{{ route('pets.index') }}" class="flex items-center gap-2">

                <select
                    name="status"
                    class="rounded-lg border px-3 py-2 text-sm shadow-sm
                        bg-white text-neutral-800 dark:bg-neutral-800 dark:text-white
                        border-neutral-300 dark:border-neutral-600
                        focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    @foreach (statusLabel() as $value => $label)
                        <option value="{{ $value }}" @selected($status === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Filtruj
                </button>
            </form>
            <a href="{{ route('pets.create') }}" class="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm text-white hover:bg-green-700">
                + Dodaj zwierzaka
            </a>
        </div>

        {{-- Komunikaty --}}
        @if (session('success'))
            <div class="rounded-lg bg-green-100 px-4 py-2 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif
        @error('error')
            <div class="rounded-lg bg-red-100 px-4 py-2 text-red-800 shadow">
                {{ $message }}
            </div>
        @enderror

        {{-- Lista zwierzaków --}}
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($pets as $pet)
                <div class="relative overflow-hidden rounded-xl border border-neutral-200 p-4 shadow-sm hover:shadow-md dark:border-neutral-700 dark:bg-neutral-800">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-lg font-semibold text-neutral-800 dark:text-neutral-100">
                            ID: {{ $pet['id'] }}
                        </h2>
                        <h2>
                            Nazwa: {{ $pet['name'] ?? 'Bez nazwy' }}
                        </h2>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Status: <span class="font-medium">{{ statusLabel($pet['status']) }}</span></p>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('pets.show', $pet['id']) }}" class="rounded-md border border-blue-500 px-3 py-1 text-sm text-blue-600 hover:bg-blue-50 dark:hover:bg-neutral-700">Zobacz</a>
                        <a href="{{ route('pets.edit', $pet['id']) }}" class="rounded-md border border-yellow-500 px-3 py-1 text-sm text-yellow-600 hover:bg-yellow-50 dark:hover:bg-neutral-700">Edytuj</a>
                        <form method="POST" action="{{ route('pets.destroy', $pet['id']) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="rounded-md border border-red-500 px-3 py-1 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-neutral-700">Usuń</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 dark:text-neutral-400">Brak wyników dla podanego statusu.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
