@use('Namu\WireChat\Facades\WireChat')
<div id="new-chat-modal ">

    <div
        class="relative mx-auto h-96 w-full overflow-auto border bg-white px-7 dark:border-gray-700 dark:bg-gray-800 dark:text-white sm:max-w-lg sm:rounded-lg">

        <header class="sticky top-0 z-10 bg-white py-2 dark:bg-gray-800">
            <div class="flex items-center justify-between pb-2">

                <h3 class="text-lg font-semibold">New Chat</h3>

                <x-wirechat::actions.close-modal>
                    {{-- <button
             dusk="close_modal_button"
                class="p-2  text-gray-600 hover:dark:bg-gray-700 hover:dark:text-white rounded-full hover:text-gray-800 hover:bg-gray-50">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button> --}}
                </x-wirechat::actions.close-modal>

            </div>

            <section class="flex flex-wrap items-center border-b px-0 dark:border-gray-700">
                <input dusk="search_users_field" autofocus type="search" id="users-search-field"
                    wire:model.live.debounce='search' autocomplete="off" placeholder="Search"
                    class="w-auto rounded-lg border-0 bg-none px-0 outline-none hover:ring-0 focus:outline-none focus:ring-0 dark:bg-gray-800">

            </section>
        </header>

        <div class="relative w-full">

            {{-- New Group button --}}
            @if (WireChat::showNewGroupModalButton() && auth()->user()->canCreateGroups())
                {{-- Buton to trigger opening of new grop modal --}}
                <x-wirechat::actions.new-group widget="{{ $this->isWidget() }}">
                    <button @dusk="open_new_group_modal_button"
                        class="my-4 flex w-full items-center gap-3 rounded-lg border p-2 transition-colors hover:border-gray-300 dark:border-gray-800 dark:hover:border-gray-700">
                        <span style=" color: var(--wirechat-primary-color); " class="rounded-full bg-gray-100 p-1">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>
                        </span>

                        <p class="dark:text-white">New group</p>
                    </button>
                </x-wirechat::actions.new-group>
            @endif
            <section class="my-4">
                @if ($users)

                    <ul class="flex flex-col overflow-auto">

                        @foreach ($users as $key => $user)
                            <li wire:key="user-{{ $key }}"
                                wire:click="createConversation('{{ $user->id }}',{{ json_encode(get_class($user)) }})"
                                class="group flex cursor-pointer items-center gap-2 p-2">

                                <x-wirechat::avatar src="{{ $user->cover_url }}" class="h-10 w-10" />

                                <p class="transition-all group-hover:underline">
                                    {{ $user->display_name }}</p>

                            </li>
                        @endforeach


                    </ul>
                    {{-- @else
                No accounts found --}}

                @endif

            </section>
        </div>
    </div>
</div>
