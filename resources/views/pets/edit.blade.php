<x-layouts.app :title="__('Edytuj zwierzaka')">
    <div class="max-w-xl mx-auto p-6 text-neutral-900 dark:bg-neutral-900 dark:text-neutral-100 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-6">Edytuj zwierzaka</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 px-4 py-2 text-red-800 dark:bg-red-800 dark:text-red-100">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pets.update', $pet['id']) }}" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nazwa --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-1">Nazwa</label>
                <input type="text" name="name" id="name" required
                    value="{{ old('name', $pet['name'] ?? '') }}"
                    class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full rounded-lg border px-3 py-2 text-neutral-800 dark:bg-neutral-800 dark:text-white border-neutral-300 dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach (statusLabel() as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $pet['status']) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Akcje --}}
            <div class="flex justify-between">
                <a href="{{ route('pets.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">← Wróć</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Zapisz zmiany
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
