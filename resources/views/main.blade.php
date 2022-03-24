@php
/* Total slots per raid / 5 (group slots) = amount of groups in raid */
$groups = count($raidRoster) / 5;
$j = 0;
@endphp

@foreach ($raidRoster as $rosterCharacter)
    @php unset($availableCharacters[($rosterCharacter->character_id)-1]) @endphp
@endforeach

<x-layout>
    @include('_header')
    <div class="container mx-auto">                
        <div class="grid grid-cols-10 gap-6">
            <div class="col-span-3">
                <div class="label text-center pt-2">
                    Roster ({{ count($characters) }} Active)
                </div>
            </div>
            {{-- RAID TITLE; CURRENTLY CLICK TO EDIT - POSSIBLY REFACTOR TO TABLE IN FUTURE TO STORE RAIDS INCL. NAMES AND SETUPS --}}
            <input value="Lorem Ipsum (Placeholder)" type="text" class="label col-span-4 text-center"/>
            {{-- LEFT COLUMN --}}
            <div class="col-span-3">
                <x-datepicker />
            </div>

            <div class="w-full col-span-3">

                <div class="grid grid-cols-6 text-center">
                    <div class="pl-2 col-span-4 label">
                        Name
                    </div>
                    <div class="pr-1 label">
                        MS
                    </div>
                    <div class="pr-1 label">
                        OS
                    </div>
                </div>

                {{-- DATA --}}
                @foreach ($characters as $character)
                    <x-character-card :character="$character" />
                @endforeach
            </div>

            {{-- MAIN COLUMN --}}
            <div class="w-full col-span-4">
                {{-- FOR EVERY GROUP (i) --}}
                @for ($i = 0; $i < $groups; $i++)
                        @if ($i + 1 == $groups)
                            {{-- LAST GROUP == BACKUP --}}
                            <div class="label text-center">
                                Backup
                            </div>
                        @else
                            <div class="label text-center">
                                Group {{ $i+1 }}
                            </div>
                        @endif

                        {{-- FOR EVERY PLAYER (j) IN ROSTER --}}
                        @for ($j; $j < count($raidRoster); $j++)
                            <div class="flex justify-center">
                                {{-- CREATE DROPDOWN BUTTON --}}
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button
                                            class="relative inline-flex text-sm font-semibold w-full md:w-56 lg:w-56 text-left text-black rounded-xl outline border border-black"
                                            style="background-color: {{ $raidRoster[$j]->character->ms->class->color }}">

                                            <div class="specc inline-block opacity-90">
                                                <img src="/images/icons/{{ $raidRoster[$j]->character->ms->name }}.jpg"
                                                    alt="Main Specialization (MS)">
                                            </div>

                                            <div class="pl-1 pt-1.5">
                                                {{ isset($raidRoster[$j]->character->name) ? ucwords($raidRoster[$j]->character->name) : 'Player' }}
                                            </div>

                                            <x-icon name="down-arrow" class="absolute pointer-events-none mt-1"
                                                style="right: 4px;" />
                                        </button>
                                    </x-slot>

                                    {{-- DROPDOWN ITEMS --}}
                                    @foreach ($availableCharacters as $character)
                                        <x-dropdown-item :index="$j" :character="$character"
                                            :active="isset($currentCategory) && $currentCategory->is($character)">
                                            {{ ucwords($character->name) }} ({{ $character->ms->class->name }})
                                        </x-dropdown-item>
                                    @endforeach
                                </x-dropdown>
                            </div>

                            {{-- GROUP IS FULL -> BREAK FOR NEXT GROUP --}}
                            @if (($j + 1) % 5 == 0)
                                @php($j++)
                                @break
                            @endif
                        @endfor
                @endfor
            </div>

            <div class="w-full col-span-3">
                <div class="label text-center">
                    Buffs
                </div>

                <div class="text-white text-xs">
                    @foreach ($effects as $effect)
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
                    @endforeach
                </div>

                <div class="label text-center">
                    Debuffs
                </div>

                <div class="label text-center">
                    Out:
                </div>

                @foreach ($availableCharacters as $character)
                        <x-character-card :character="$character" />
                @endforeach
            </div>
        </div>
    </div>

@include('_footer')
</x-layout>
