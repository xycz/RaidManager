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
    <div class="container inline-flex">
        {{-- LEFT COLUMN --}}
        <div class="side-col">
            {{-- LEFT TITLE --}}
            <div class="text-center text-white">
                Roster ({{ count($characters) }} Active)
            </div>
            @foreach ($characters as $character)
                <x-character-card :character="$character" />
            @endforeach
        </div>

        {{-- MAIN COLUMN --}}
        <div class="main-col">
            {{-- RAID TITLE; CURRENTLY CLICK TO EDIT - POSSIBLY REFACTOR TO TABLE IN FUTURE TO STORE RAIDS INCL. NAMES AND SETUPS --}}
            <div class="text-center text-white">
                <input value="Raid Name" type="text" style="text-align: center; background-color: hsl(175, 20%, 5%)" />
            </div>

            {{-- FOR EVERY GROUP (i) --}}
            @for ($i = 0; $i < $groups; $i++)
                <div class="group-col">
                    @if (($i+1)==$groups) {{-- LAST GROUP == BACKUP --}}
                        Backup:
                    @endif

                    {{-- FOR EVERY PLAYER (j) IN ROSTER --}}
                    @for ($j; $j < count($raidRoster); $j++)
                        <div class="relative inline-flex bg-gray-100 rounded-xl mt-2">
                            {{-- CREATE DROPDOWN BUTTON --}}
                            <x-dropdown>
                                <x-slot name="trigger">
                                        <button
                                        class="py-1 pl-1 text-sm font-semibold w-full md:w-36 lg:w-36 text-left flex lg:inline-flex text-black rounded-xl outline border border-black"
                                        style="background-color: {{ $raidRoster[$j]->character->ms->class->color }}">

                                        <div class="specc inline-block opacity-90">
                                            <img src="/images/icons/{{ $raidRoster[$j]->character->ms->name }}.jpg" alt="Main Specialization (MS)">
                                        </div>
                                        
                                        <div class="pl-2 pt-1">
                                            {{ isset($raidRoster[$j]->character->name) ? ucwords($raidRoster[$j]->character->name) : 'Player' }}
                                        </div>

                                        <x-icon name="down-arrow" class="absolute pointer-events-none"
                                            style="right: 4px;" />
                                    </button>
                                </x-slot>
                                
                                {{-- DROPDOWN ITEMS --}}
                                @foreach ($availableCharacters as $character)
                                    <x-dropdown-item :index="$j" :character="$character"
                                        :active="isset($currentCategory) && $currentCategory->is($character)">
                                        {{ ucwords($character->name) }} ({{$character->ms->class->name}})
                                    </x-dropdown-item>
                                @endforeach
                            </x-dropdown>
                        </div>

                        {{-- GROUP IS FULL -> BREAK FOR NEXT GROUP --}}
                        @if(($j+1)%5 == 0)
                            @php($j++)
                            @break
                        @endif
                    @endfor
                </div>
            @endfor
            
            <div class="group-col">
                <div class="text-center text-white pb-2">
                    Out:
                </div>
                @foreach($availableCharacters as $character)
                    <div>
                        {{ $character->name }}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT COLUMN PLACEHOLDER --}}
        <div class="side-col">
            {{-- RIGHT TITLE --}}
            <div class="text-center text-white">
                Buffs/Debuffs
            </div>
        </div>

        @include('_footer')
</x-layout>
