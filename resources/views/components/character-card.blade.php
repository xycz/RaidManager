@props(['character'])
<div style="background-color: {{ $character->ms->class->color }}" class="text-gray-900 rounded-xl border border-black border-opacity-50">
    <div class="container">
        <div class="name inline font-semibold text-sm pl-2">
            {{ $character->name }}
        </div>

        <div class="specc inline-block opacity-90">
            <img src="/images/icons/{{ $character->ms->name }}.jpg" alt="Main Specialization (MS)">
        </div>

        <div class="specc inline-block opacity-90">
            <img src="/images/icons/{{ $character->os->name }}.jpg" alt="Off Specialization (OS)">
        </div>
    </div>
</div>
