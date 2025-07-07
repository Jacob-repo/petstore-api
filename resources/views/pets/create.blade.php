<x-layouts.app :title="__('Dodaj zwierzaka')">
    <div class="max-w-xl mx-auto p-6 space-y-6 text-neutral-900 dark:bg-neutral-900 dark:text-neutral-100 rounded-xl shadow">
        <h1 class="text-2xl font-bold">Dodaj zwierzaka</h1>

        {{-- Komunikaty --}}
        @if ($errors->any())
            <div class="rounded-lg bg-red-100 px-4 py-2 text-red-800 dark:bg-red-800 dark:text-red-100">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formularz --}}
        <form method="POST" action="{{ route('pets.store') }}" class="space-y-6">
            @csrf

            {{-- Nazwa --}}
            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium">Nazwa</label>
                <input type="text" name="name" id="name" required
                       class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white
                              border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- Status --}}
            <div class="space-y-1">
                <label for="status" class="block text-sm font-medium">Status</label>
                <select name="status" id="status" required
                        class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white
                            border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach (statusLabel() as $value => $label)
                        <option value="{{ $value }}" @selected(old('status') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Kategoria --}}
            <div class="space-y-1">
                <label for="category_name" class="block text-sm font-medium">Kategoria</label>
                <input type="text" name="category[name]" id="category_name"
                       placeholder="np. Pies, Kot"
                       class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white
                              border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- Tagi --}}
            <div class="space-y-1">
                <label for="tag_name" class="block text-sm font-medium">Tag</label>
                <input type="text" name="tags[0][name]" id="tag_name"
                       placeholder="np. Uroczy, Aktywny"
                       class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white
                              border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- Zdjęcie --}}
            <div class="space-y-1">
                <label for="photo_url" class="block text-sm font-medium">Link do zdjęcia</label>
                <input type="text" name="photoUrls[0]" id="photo_url"
                       placeholder="https://example.com/piesek.jpg"
                       class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white
                              border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- Akcje --}}
            <div class="flex justify-between pt-4">
                <a href="{{ route('pets.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">← Wróć</a>
                <button type="submit"
                        class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                    Zapisz
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
