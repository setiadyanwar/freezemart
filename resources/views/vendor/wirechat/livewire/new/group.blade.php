<div x-data dusk="new_group_modal">

    <div
        class="relative h-[410px] w-full items-center justify-center overflow-auto border bg-white dark:border-gray-700 dark:bg-gray-800 dark:text-white sm:max-w-lg sm:rounded-lg">

        {{--  Group Details --}}
        <section x-show="$wire.showAddMembers==false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full">

            <form wire:submit="validateDetails()" class="flex h-full flex-col p-4">

                <header>

                    <div class="flex w-full gap-10">

                        @if ($photo)
                            <div class="relative h-28 w-28 overflow-clip rounded-full">
                                <x-wirechat::avatar :src="$photo->temporaryUrl()" class="h-28 w-28" />
                                <button
                                    class="absolute inset-x-0 bottom-0 flex items-center justify-center bg-white/40 text-red-800"
                                    wire:click="deletePhoto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <label class="cursor-pointer">
                                <x-wirechat::avatar wire:loading.class="animate-pulse" wire:target="photo"
                                    :group="true" class="h-28 w-28" />
                                <input wire:model="photo" dusk="add_photo_field" type="file" hidden
                                    accept=".jpg,.jpeg,.png,.webp">
                            </label>
                        @endif

                        <div class="my-auto">

                            <label for="name">Group Name</label>

                            <input id='name' type="text" wire:model='name' autofocus placeholder="Enter name"
                                class="w-full w-full border-0 bg-inherit px-0 outline-none hover:ring-0 focus:outline-none focus:ring-0 dark:text-white">

                            <span class="text-sm text-red-500">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>


                    </div>

                    <span class="text-sm text-red-500">
                        @error('photo')
                            {{ $message }}
                        @enderror
                    </span>

                </header>

                <main class="my-5">
                    <div class="my-auto space-y-2">

                        <label for="description">Description</label>

                        <textarea id='description' type="text" wire:model='description' placeholder="Optional" rows="4"
                            class="w-full w-full resize-none rounded-lg border-gray-200 bg-inherit outline-none hover:ring-0 focus:border-gray-200 focus:outline-none focus:ring-0 dark:border-gray-700 dark:text-white">
                    </textarea>


                        <span class="text-sm text-red-500">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>

                </main>

                <footer class="mt-auto flex justify-end gap-4">
                    <x-wirechat::actions.close-modal>
                        <button type="button"
                            dusk="cancel_create_new_group_button"class="font-bold dark:hover:bg-gray-700 p-3 px-4 rounded-xl ">
                            Cancel
                        </button>
                    </x-wirechat::actions.close-modal>

                    <button type="submit" :disabled="!($wire.name?.trim()?.length)" dusk="next_button"
                        :class="{
                            'cursor-not-allowed hover:bg-none dark:hover:bg-inherit opacity-70': !($wire.name?.trim()
                                ?.length)
                        }"
                        class="rounded-xl p-3 px-4 font-bold transition dark:hover:bg-gray-700">
                        Next
                    </button>
                </footer>
            </form>

        </section>

        {{-- Add members --}}
        <section dusk="add_members_section" x-cloak x-show="$wire.showAddMembers==true"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
            class="relative h-full overflow-x-hidden px-7">

            <header class="sticky top-0 z-10 bg-white py-2 dark:bg-gray-800">
                <div class="flex items-center pb-2">

                    <button @click="$wire.showAddMembers=false"
                        class="ml-0 rounded-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-800 hover:dark:bg-gray-700 hover:dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>

                    </button>

                    <h3 class="mx-auto text-sm font-semibold"><span>Add Members</span> {{ count($selectedMembers) }} /
                        {{ $maxGroupMembers }}</h3>

                    <button wire:click="create" wire:loading.attr="disabled" wire:target='create'
                        class="ml-0 rounded-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-800 disabled:cursor-not-allowed dark:text-gray-300 hover:dark:bg-gray-700 hover:dark:text-white">
                        Create
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
                <section class="flex flex-wrap items-center border-b px-0 dark:border-gray-700">
                    <input type="search" id="users-search-field" wire:model.live.debounce='search' autocomplete="off"
                        placeholder="Search"
                        class="w-auto w-full rounded-lg border-0 bg-none outline-none hover:ring-0 focus:outline-none focus:ring-0 dark:bg-gray-800">
                </section>


                <section class="my-2 overflow-x-hidden">
                    <ul style="
                     -ms-overflow-style: none;
                     scrollbar-width: none;
                    "
                        class="flex w-full gap-3 overflow-x-auto">

                        @if ($selectedMembers)

                            @foreach ($selectedMembers as $key => $member)
                                <li class="flex min-w-fit items-center text-nowrap rounded bg-gray-100 px-2 py-1 text-sm font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300"
                                    wire:key="selected-member-{{ $member->id }}">
                                    {{ $member->display_name }}
                                    <button type="button"
                                        wire:click="toggleMember('{{ $member->id }}',{{ json_encode(get_class($member)) }})"
                                        class="ms-2 flex items-center rounded-sm bg-transparent p-1 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300"
                                        aria-label="Remove">
                                        <svg class="h-2 w-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Remove badge</span>

                                    </button>
                                </li>
                            @endforeach
                        @endif




                    </ul>
                </section>

            </header>


            <div class="relative w-full">
                {{-- <h5 class="text font-semibold text-gray-800 dark:text-gray-100">Recent Chats</h5> --}}
                <section class="my-4">
                    @if ($users)

                        <ul class="flex flex-col overflow-auto">

                            @foreach ($users as $key => $user)
                                <li class="group flex cursor-pointer items-center gap-2 p-2">

                                    <label
                                        wire:click="toggleMember('{{ $user->id }}',{{ json_encode(get_class($user)) }})"
                                        class="flex w-full cursor-pointer items-center gap-2">
                                        <x-wirechat::avatar src="{{ $user->cover_url }}" class="h-10 w-10" />

                                        <p class="truncate transition-all group-hover:underline">
                                            {{ $user->display_name }}</p>

                                        <div class="ml-auto">
                                            @if ($selectedMembers->contains(fn($member) => $member->id == $user->id && get_class($member) == get_class($user)))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="bi bi-plus-square-fill h-6 w-6 text-green-500"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-square-dotted h-6 w-6"
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
        </section>

    </div>
</div>
