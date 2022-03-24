@props(['effect', 'buffs', 'raidRoster'])
<div class="grid grid-cols-8 gap-1">
<div class="col-span-1">
    <img src="/images/icons/spells/{{ $effect->slug }}.jpg" title="{{ $effect->name }}" alt="Buff Effect Icon" style="max-height: 100%; max-width: 100%;">
</div>
{{-- assign buffs based on index (active roster size) based on class/specc --}}
@for ($i = 0; $i < 10; $i++)
    @foreach ($buffs as $buff)
        @if ($buff->effect == $effect->id  && !$effect->assigned)
            {{-- CLASS_REQ FOR BUFF MATCHES ROSTERINDEX CLASS & INDEX IS NOT ASSIGNED A BUFF --}}
            @if ($raidRoster[$i]->character->ms->wowclass_id == $buff->req_class && !$raidRoster[$i]->buff_assigned)
                {{-- display and assign --}}
                <div class="col-span-6">
                    <div class="pt-1.5">
                        {{ $raidRoster[$i]->character->name }}
                    </div>
                </div>
                @php ($raidRoster[$i]->buff_assigned = 1)
                @php ($effect->assigned = 1)
                @break
            {{-- SPECC_REQ FOR BUFF MATCHES ROSTERINDEX SPECC & INDEX IS NOT ASSIGNED A BUFF --}}
            @elseif ($raidRoster[$i]->character->ms->id == $buff->req_specc && !$raidRoster[$i]->buff_assigned)
                {{-- display and assign --}}
                <div class="col-span-6">
                    <div class="pt-1.5">
                        {{ $raidRoster[$i]->character->name }}
                    </div>
                </div>                          
                @php ($raidRoster[$i]->buff_assigned = 1)
                @php ($effect->assigned = 1)
                @break
            @endif
        @endif
    @endforeach
@endfor
</div>