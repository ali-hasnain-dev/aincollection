<x-filament-panels::page>
    <x-filament-panels::form wire:submit="BasicFormSave">
        {{ $this->BasicForm }}

        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>

    <x-filament-panels::form wire:submit="socialFormSave">
        {{ $this->socialForm }}

        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>

    <x-filament-panels::form wire:submit="contctFormSave">
        {{ $this->contctForm }}

        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
