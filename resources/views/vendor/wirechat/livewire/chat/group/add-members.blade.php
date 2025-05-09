<div
    class="h-[calc(100vh_-_10rem)] overflow-y-auto overflow-x-hidden border bg-white dark:border-gray-700 dark:bg-gray-800 dark:text-white sm:h-[450px]">

    <header class="sticky top-0 z-10 p-2 bg-white dark:bg-gray-800">
        <div class="flex items-center pb-2">

            <x-wirechat::actions.close-modal>
                <button
                    class="p-2 ml-0 text-gray-600 rounded-full hover:bg-gray-50 hover:text-gray-800 hover:dark:bg-gray-700 hover:dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </button>
            </x-wirechat::actions.close-modal>

            <h3 class="mx-auto text-sm font-semibold"><span>Add Members</span> {{ $newTotalCount }} /
                {{ $maxGroupMembers }}</h3>

            <button wire:click="save" wire:loading.attr="disabled" wire:target='save' @disabled(count($selectedMembers) == 0)
                @class([
                    'p-2 disabled:cursor-not-allowed  disabled:hover:bg-inherit ml-0 text-gray-600 dark:text-gray-300 hover:dark:bg-gray-700 hover:dark:text-white rounded-full hover:text-gray-800 hover:bg-gray-50',
                    'cursor-not-allowed hover:bg-none dark:hover:bg-inherit hover:bg-inherit  opacity-70' =>
                        count($selectedMembers) == 0,
                ]) class="">
                Save
            </button>

        </div>

        {{-- Member limit error --}}
        <div x-data="{ showError: false }"
            x-on:show-member-limit-error.window="
      showError=true;
      setTimeout(()=>{ showError=false; },1500);
      "
            class="mx-auto text-sm text-red-500">
            <span x-transition x-show="showError">
                Members cannot exceed {{ $maxGroupMembers }}
            </span>
        </div>

        <section class="flex flex-wrap items-center px-0 border-b dark:border-gray-700">
            <input type="search" id="users-search-field" wire:model.live.debounce='search' autocomplete="off"
                placeholder="Search"
                class="w-auto w-full border-0 rounded-lg outline-none bg-none hover:ring-0 focus:outline-none focus:ring-0 dark:bg-gray-800">
        </section>


        <section class="my-2 overflow-x-hidden">
            <ul style="-ms-overflow-style: none;scrollbar-width: none;
          "
                class="flex w-full gap-3 overflow-x-auto">

                @if ($selectedMembers)

                    @foreach ($selectedMembers as $key => $member)
                        <li class="flex items-center px-2 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded min-w-fit text-nowrap dark:bg-gray-700 dark:text-gray-300"
                            wire:key="selected-member-{{ $member->id }}">
                            {{ $member->display_name }}
                            <button type="button"
                                wire:click="toggleMember('{{ $member->id }}',{{ json_encode(get_class($member)) }})"
                                class="flex items-center p-1 text-sm text-gray-400 bg-transparent rounded-sm ms-2 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300"
                                aria-label="Remove">
                                <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Remove badge</span>

                            </button>
                        </li>
                    @endforeach
                @endif




            </ul>
        </section>

    </header>

    <div class="relative w-full p-2">
        {{-- <h5 class="font-semibold text-gray-800 text dark:text-gray-100">Recent Chats</h5> --}}
        <section class="my-4">
            @if ($users)

                <ul class="flex flex-col overflow-auto">

                    @foreach ($users as $key => $user)
                        @php
                            $isAlreadyAParticipant = $user->belongsToConversation($conversation);
                        @endphp
                        <li wire:key="users-{{ $key }}"
                            class="flex items-center gap-2 p-2 cursor-pointer group">

                            <label {{-- The wire:click attribute is only rendered if $isAlreadyAParticipant is false. --}}
                                @if (!$isAlreadyAParticipant) wire:click="toggleMember('{{ $user->id }}', {{ json_encode(get_class($user)) }})" @endif
                                class="flex items-center w-full gap-2 cursor-pointer">
                                <x-wirechat::avatar src="{{ $user->cover_url }}" class="w-10 h-10" />

                                <div @class(['opacity-70' => $isAlreadyAParticipant])>
                                    <p @class([
                                        'transition-all truncate',
                                        'group-hover:underline ' => !$isAlreadyAParticipant,
                                    ])>
                                        {{ $user->display_name }}</p>

                                    <span @class(['text-gray-600 dark:text-gray-400 text-sm'])>
                                        @if ($isAlreadyAParticipant)
                                            Already added to group
                                        @endif
                                    </span>
                                </div>

                                <div class="ml-auto">
                                    @if (
                                        $selectedMembers->contains(fn($member) => $member->id == $user->id && get_class($member) == get_class($user)) ||
                                            $isAlreadyAParticipant)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-6 h-6 text-green-500 bi bi-plus-square-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-6 h-6 bi bi-plus-square-dotted"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 0q-.25 0-.487.048l.194.98A1.5 1.5 0 0 1 2.5 1h.458V0zm2.292 0h-.917v1h.917zm1.833 0h-.917v1h.917zm1.833 0h-.916v1h.916zm1.834 0h-.917v1h.917zm1.833 0h-.917v1h.917zM13.5 0h-.458v1h.458q.151 0 .293.029l.194-.981A2.5 2.5 0 0 0 13.5 0m2.079 1.11a2.5 2.5 0 0 0-.69-.689l-.556.831q.248.167.415.415l.83-.556zM1.11.421a2.5 2.5 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415zM16 2.5q0-.25-.048-.487l-.98.194q.027.141.028.293v.458h1zM.048 2.013A2.5 2.5 0 0 0 0 2.5v.458h1V2.5q0-.151.029-.293zM0 3.875v.917h1v-.917zm16 .917v-.917h-1v.917zM0 5.708v.917h1v-.917zm16 .917v-.917h-1v.917zM0 7.542v.916h1v-.916zm15 .916h1v-.916h-1zM0 9.375v.917h1v-.917zm16 .917v-.917h-1v.917zm-16 .916v.917h1v-.917zm16 .917v-.917h-1v.917zm-16 .917v.458q0 .25.048.487l.98-.194A1.5 1.5 0 0 1 1 13.5v-.458zm16 .458v-.458h-1v.458q0 .151-.029.293l.981.194Q16 13.75 16 13.5M.421 14.89c.183.272.417.506.69.689l.556-.831a1.5 1.5 0 0 1-.415-.415zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373Q2.25 16 2.5 16h.458v-1H2.5q-.151 0-.293-.029zM13.5 16q.25 0 .487-.048l-.194-.98A1.5 1.5 0 0 1 13.5 15h-.458v1zm-9.625 0h.917v-1h-.917zm1.833 0h.917v-1h-.917zm1.834-1v1h.916v-1zm1.833 1h.917v-1h-.917zm1.833 0h.917v-1h-.917zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                        </svg>
                                    @endif
                                </div>
                            </label>

                        </li>
                    @endforeach



                </ul>
            @endif
        </section>
    </div>

</div>
