<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <h2 class="inline-flex mt-2">By Lary Laracore <img src="/images/lary-head.svg"
                                                        alt="Head of Lary the mascot"></h2>

    <p class="text-sm mt-14">
        Another year. Another update. We're refreshing the popular Laravel series with new content.
        I'm going to keep you guys up to speed with what's going on!
    </p>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <!--  Category -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
            <x-dropdown>

                <x-slot name="trigger">
                    <button class="lg:inline-flex py-2 pl-3 pr-9 text-left text-sm font-semibold w-32">

                        {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

                        <x-down-arrow class="absolute pointer-events-none" />
                    </button>

                </x-slot>
                <x-dropdown-item href="/">All</x-drop-down-item>

                @foreach ($categories as $category)
                {{ isset($currentCategory) && $currentCategory->is($category) ? 'bg-blue- text-white' : '' }}
                    <x-dropdown-item 
                        href="/categories/{{ $category->slug }}"
                        :active="isset($currentCategory) && $currentCategory->is($category)">
                            {{ ucwords($category->name)}} 
                    </x-drop-down-item>
                @endforeach
        </x-dropdown>
        </div>


        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">
                <input type="text" name="search" placeholder="Find something"
                        class="bg-transparent placeholder-black font-semibold text-sm">
            </form>
        </div>
    </div>
</header>