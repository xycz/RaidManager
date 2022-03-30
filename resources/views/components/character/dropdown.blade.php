@props(['trigger'])

<div x-data="{ show: false }" @click.away="show = false">
    {{-- SHOW ONLY WHEN DROPDOWN IS TRIGGERED --}}
    <div @click="show = ! show">
        {{ $trigger }}
    </div>

    {{-- AVAILABLE CHARACTERS --}}
    <div x-show="show" class="absolute py-2 bg-gray-100 rounded-xl z-50 max-h-44 w-56" style="display: none">
        {{ $slot }}
    </div>
</div>
