@props(['character'])
<div style="background-color: {{ $character->ms->class->color }}" class="text-gray-900 rounded-xl border border-black border-opacity-50">
    <div class="grid grid-cols-6">
        <div class="font-semibold text-xs text-center col-span-4 pt-1.5 pl-2">
            {{ $character->name }}
        </div>

        <div class="specc opacity-90 h-6 flex items-center justify-center">
            <img src="/images/icons/{{ $character->ms->name }}.jpg" alt="Main Specialization (MS)" style="max-height: 100%; max-width: 100%;">
        </div>

        <div class="specc opacity-90 h-6 flex items-center justify-center">
            <img src="/images/icons/{{ $character->os->name }}.jpg" alt="Off Specialization (OS)" style="max-height: 100%; max-width: 100%;">
        </div>
    </div>
</div>
