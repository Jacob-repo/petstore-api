<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Witam!') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('Zarządzanie listą zwierząt dostępnych w systemie pod zakładką "Petstore". Miłego dnia!') }}</flux:subheading>
            <flux:separator variant="subtle" />
        </div>
    </div>
</x-layouts.app>
