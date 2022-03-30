@props(['active' => false, 'character', 'index'])

@php
$classes = 'block w-full text-left px-3 text-xs leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white text-black';

if ($active) $classes .= ' bg-blue-500 text-white';
@endphp
  
<form method="POST" action="/updateRoster" id="roster">
    @csrf

    <input type="hidden" name="id" id="id" value="{{$index+1}}" required>
    <input type="hidden" name="character_id" id="character_id" value="{{ isset($character->id) ? ($character->id) : '1' }}" required>
    <input type="hidden" name="buff_assigned" id="buff_assigned" value="0" required>
    <input type="hidden" name="is_backup" id="is_backup" value="1" required>

    <button type="submit" {{ $attributes(['class' => $classes]) }}>
        {{ $slot }}
    </button>
</form>
