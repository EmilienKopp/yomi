<script lang="ts">
    import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.svelte";
    import InteractivePassage from "../Components/InteractivePassage.svelte";
    import { Link } from "@inertiajs/svelte";
    
    // Dummy data for the dashboard
    const languages = [
        { id: 1, code: 'ja', name: 'Japanese', nativeName: '日本語', progress: 42 },
        { id: 2, code: 'fr', name: 'French', nativeName: 'Français', progress: 68 },
        { id: 3, code: 'es', name: 'Spanish', nativeName: 'Español', progress: 23 },
        { id: 4, code: 'de', name: 'German', nativeName: 'Deutsch', progress: 15 }
    ];
    
    const recentPassages = [
        { id: 1, title: 'A Day in Tokyo', language: 'Japanese', date: '2025-03-20', wordCount: 245 },
        { id: 2, title: 'French Cuisine', language: 'French', date: '2025-03-18', wordCount: 312 },
        { id: 3, title: 'Barcelona Travel Guide', language: 'Spanish', date: '2025-03-15', wordCount: 178 }
    ];
    
    const vocabularyStats = {
        totalWords: 427,
        newToday: 12,
        reviewsDue: 34,
        masteredWords: 156
    };
    
    const learningGames = [
        { id: 1, name: 'Word Match', description: 'Match words with their meanings', icon: 'puzzle-piece' },
        { id: 2, name: 'Flashcards', description: 'Review vocabulary with flashcards', icon: 'cards' },
        { id: 3, name: 'Word Challenge', description: 'Challenge friends to vocabulary contests', icon: 'trophy' },
        { id: 4, name: 'Sentence Builder', description: 'Create sentences with new vocabulary', icon: 'pencil' }
    ];
    
    // Active language (would be set by user selection)
    let activeLanguage = $state(languages[0]);
    
    // State for showing the interactive passage demo
    let showPassageDemo = $state(false);
</script>

<AuthenticatedLayout>
    {#snippet header()}
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="relative mr-4">
                    <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-primary-400 to-secondary-400 opacity-30 blur"></div>
                    <div class="relative">
                        <h2 class="text-2xl font-bold leading-tight text-gray-800">
                            Learning Journey
                        </h2>
                    </div>
                </div>
                <div class="hidden rounded-full bg-accent-100 px-3 py-1 text-xs font-medium text-accent-800 sm:block">
                    {new Date().toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' })}
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-secondary-400 to-primary-400 opacity-30 blur"></div>
                <div class="relative">
                    <select 
                        class="appearance-none rounded-full border-none bg-white py-2 pl-4 pr-10 text-sm font-medium text-gray-700 shadow-md focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        bind:value={activeLanguage}
                    >
                        {#each languages as language}
                            <option value={language}>{language.name} ({language.nativeName})</option>
                        {/each}
                    </select>
                </div>
            </div>
        </div>
    {/snippet}

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Language Progress -->
            <div class="mb-10">
                <div class="mb-6 flex items-center">
                    <h3 class="text-xl font-bold text-gray-900">Your Progress in {activeLanguage.name}</h3>
                    <div class="ml-3 h-1 w-24 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500"></div>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="group overflow-hidden rounded-2xl bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-primary-400 to-primary-600 text-white transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Words</p>
                                <p class="text-2xl font-semibold text-gray-900">{vocabularyStats.totalWords}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="group overflow-hidden rounded-2xl bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-secondary-400 to-secondary-600 text-white transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">New Today</p>
                                <p class="text-2xl font-semibold text-gray-900">{vocabularyStats.newToday}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="group overflow-hidden rounded-2xl bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-accent-400 to-accent-600 text-white transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Reviews Due</p>
                                <p class="text-2xl font-semibold text-gray-900">{vocabularyStats.reviewsDue}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="group overflow-hidden rounded-2xl bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="mr-4 flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-green-400 to-green-600 text-white transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Mastered</p>
                                <p class="text-2xl font-semibold text-gray-900">{vocabularyStats.masteredWords}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Interactive Passage Demo -->
            <div class="mb-10">
                <div class="mb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <h3 class="text-xl font-bold text-gray-900">Featured Passage</h3>
                        <div class="ml-3 h-1 w-24 rounded-full bg-gradient-to-r from-accent-500 to-primary-500"></div>
                    </div>
                    <button 
                        class="relative rounded-full px-4 py-2 text-sm font-medium text-primary-700 transition-all duration-300 hover:text-primary-900"
                        onclick={() => showPassageDemo = !showPassageDemo}
                    >
                        <div class="absolute inset-0 rounded-full bg-primary-100 transition-all duration-300 hover:bg-primary-200"></div>
                        <span class="relative">{showPassageDemo ? 'Hide Passage' : 'Show Passage'}</span>
                    </button>
                </div>
                
                {#if showPassageDemo}
                    <InteractivePassage />
                    <p class="mt-2 text-sm text-gray-500">
                        Try clicking on the highlighted words (東京, 日本, 首都) to see the dictionary feature in action.
                    </p>
                {/if}
            </div>
            
            <!-- Main Content Grid -->
            <div class="grid gap-8 lg:grid-cols-3">
                <!-- Recent Passages -->
                <div class="lg:col-span-2">
                    <div class="mb-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <h3 class="text-xl font-bold text-gray-900">Recent Passages</h3>
                            <div class="ml-3 h-1 w-24 rounded-full bg-gradient-to-r from-secondary-500 to-accent-500"></div>
                        </div>
                        <Link href="#" class="relative rounded-full px-4 py-2 text-sm font-medium text-primary-700 transition-all duration-300 hover:text-primary-900">
                            <div class="absolute inset-0 rounded-full bg-primary-100 transition-all duration-300 hover:bg-primary-200"></div>
                            <span class="relative">View All</span>
                        </Link>
                    </div>
                    
                    <div class="overflow-hidden rounded-2xl bg-white shadow-soft">
                        <ul class="divide-y divide-gray-200">
                            {#each recentPassages as passage}
                                <li>
                                    <Link href="#" class="block transition-colors duration-300 hover:bg-primary-50">
                                        <div class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <p class="truncate text-sm font-medium text-primary-600">{passage.title}</p>
                                                <p class="text-sm text-gray-500">{passage.date}</p>
                                            </div>
                                            <div class="mt-2 flex justify-between">
                                                <p class="text-sm text-gray-500">{passage.language}</p>
                                                <p class="text-sm text-gray-500">{passage.wordCount} words</p>
                                            </div>
                                        </div>
                                    </Link>
                                </li>
                            {/each}
                        </ul>
                        
                        <div class="bg-gradient-to-r from-primary-50 to-secondary-50 px-6 py-4">
                            <Link 
                                href="#" 
                                class="group relative flex w-full items-center justify-center overflow-hidden rounded-xl bg-gradient-to-r from-primary-600 to-secondary-600 px-4 py-3 text-sm font-medium text-white shadow-md transition-all duration-300 hover:from-primary-700 hover:to-secondary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                            >
                                <span class="absolute -top-10 left-10 h-40 w-40 rounded-full bg-white opacity-10 transition-all duration-700 group-hover:scale-150"></span>
                                <span class="relative flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Generate New Passage
                                </span>
                            </Link>
                        </div>
                    </div>
                </div>
                
                <!-- Learning Games -->
                <div>
                    <div class="mb-6 flex items-center">
                        <h3 class="text-xl font-bold text-gray-900">Learning Games</h3>
                        <div class="ml-3 h-1 w-24 rounded-full bg-gradient-to-r from-accent-500 to-secondary-500"></div>
                    </div>
                    
                    <div class="overflow-hidden rounded-2xl bg-white shadow-soft">
                        <ul class="divide-y divide-gray-200">
                            {#each learningGames as game}
                                <li>
                                    <Link href="#" class="block transition-colors duration-300 hover:bg-secondary-50">
                                        <div class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-secondary-400 to-secondary-600 text-white">
                                                    {#if game.icon === 'puzzle-piece'}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                                        </svg>
                                                    {:else if game.icon === 'cards'}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                                                        </svg>
                                                    {:else if game.icon === 'trophy'}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                        </svg>
                                                    {:else if game.icon === 'pencil'}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    {/if}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{game.name}</p>
                                                    <p class="text-sm text-gray-500">{game.description}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </li>
                            {/each}
                        </ul>
                    </div>
                    
                    <!-- Language Progress Bar -->
                    <div class="mt-8 overflow-hidden rounded-2xl bg-white p-6 shadow-soft">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900">Overall Progress</h3>
                            <span class="rounded-full bg-primary-100 px-3 py-1 text-sm font-medium text-primary-800">{activeLanguage.progress}%</span>
                        </div>
                        <div class="mt-4 h-3 w-full overflow-hidden rounded-full bg-gray-200">
                            <div class="h-3 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500" style="width: {activeLanguage.progress}%">
                                <div class="h-full w-full animate-pulse opacity-70"></div>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <Link 
                                href="#" 
                                class="relative inline-block rounded-full px-6 py-2 text-sm font-medium text-primary-700 transition-all duration-300 hover:text-primary-900"
                            >
                                <div class="absolute inset-0 rounded-full bg-primary-100 transition-all duration-300 hover:bg-primary-200"></div>
                                <span class="relative">View Detailed Progress</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
