@props(['effect', 'buffs', 'raidRoster'])
{{-- display effect title --}}
<div class="col-span-2 pt-2 font-bold">
    {{ $effect->name }}
</div>
<div class="grid grid-cols-2 gap-3">

{{-- assign buffs based on index (active roster size) based on class/specc --}}
@for ($i = 0; $i < 10; $i++)
    @foreach ($buffs as $buff)
        @if ($buff->effect == $effect->id  && !$effect->assigned)
            {{-- CLASS_REQ FOR BUFF MATCHES ROSTERINDEX CLASS & INDEX IS NOT ASSIGNED A BUFF --}}
            @if ($raidRoster[$i]->character->ms->wowclass_id == $buff->req_class && !$raidRoster[$i]->buff_assigned)
                {{-- display and assign --}}
                <div class="">
                    {{ $raidRoster[$i]->character->name }}
                </div>
                <div class="">
                    {{ $buff->name }}
                </div>
                @php ($raidRoster[$i]->buff_assigned = 1)
                @php ($effect->assigned = 1)
                @break
            {{-- SPECC_REQ FOR BUFF MATCHES ROSTERINDEX SPECC & INDEX IS NOT ASSIGNED A BUFF --}}
            @elseif ($raidRoster[$i]->character->ms->id == $buff->req_specc && !$raidRoster[$i]->buff_assigned)
                {{-- display and assign --}}
                <div class="">
                    {{ $raidRoster[$i]->character->name }}
                </div>
                <div class="">
                    {{ $buff->name }}
                </div>                               
                @php ($raidRoster[$i]->buff_assigned = 1)
                @php ($effect->assigned = 1)
                @break
            @else
                {{-- INSERT MISSING BUFF FEEDBACK --}}
            @endif
        @endif
    @endforeach
@endfor
</div>