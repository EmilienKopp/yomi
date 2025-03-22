<script lang="ts">
    // Props for the component
    interface Props {
        word: string;
        language: string;
        partOfSpeech?: string;
        pronunciation?: string;
        definitions?: string[];
        translations?: Record<string, string[]>;
        examples?: string[];
        isOpen?: boolean;
        onClose?: () => void;
        onSave?: () => void;
    }

    // Default props with dummy data
    let {
        word = "単語",
        language = "Japanese",
        partOfSpeech = "noun",
        pronunciation = "たんご",
        definitions = ["word", "vocabulary", "term"],
        translations = {
            "English": ["word", "vocabulary", "term"],
            "French": ["mot", "vocabulaire", "terme"],
            "Spanish": ["palabra", "vocabulario", "término"]
        },
        examples = [
            "この単語の意味を教えてください。",
            "新しい単語を覚えました。",
            "この単語は難しいです。"
        ],
        isOpen = true,
        onClose = () => {},
        onSave = () => {}
    }: Props = $props();

    // State for the active tab
    let activeTab = $state("definitions");

    // Function to play pronunciation audio
    function playPronunciation() {
        // In a real implementation, this would play an audio file
        console.log(`Playing pronunciation for: ${word}`);
    }
</script>

<!-- Dictionary Popup -->
{#if isOpen}
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="relative max-h-[90vh] w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-xl">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-gray-200 bg-gradient-to-r from-primary-50 to-secondary-50 px-6 py-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{word}</h3>
                    <div class="mt-1 flex items-center text-sm text-gray-500">
                        <span class="mr-2">{language}</span>
                        {#if partOfSpeech}
                            <span class="rounded-full bg-gradient-to-r from-secondary-400 to-secondary-600 px-2 py-0.5 text-xs font-medium text-white">
                                {partOfSpeech}
                            </span>
                        {/if}
                    </div>
                </div>
                <button 
                    type="button" 
                    class="rounded-full bg-white/80 p-1.5 text-gray-500 backdrop-blur-sm transition-all duration-300 hover:bg-white hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                    on:click={onClose}
                >
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Pronunciation -->
            {#if pronunciation}
                <div class="flex items-center border-b border-gray-200 bg-gray-50 px-6 py-3">
                    <span class="rounded-lg bg-white px-3 py-1 text-sm font-medium text-gray-600 shadow-sm">{pronunciation}</span>
                    <button 
                        type="button" 
                        class="ml-2 rounded-full bg-primary-100 p-1.5 text-primary-600 transition-all duration-300 hover:bg-primary-200 hover:text-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        on:click={playPronunciation}
                    >
                        <span class="sr-only">Play pronunciation</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                        </svg>
                    </button>
                </div>
            {/if}
            
            <!-- Tabs -->
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <button
                        class={`w-1/3 border-b-2 py-4 px-1 text-center text-sm font-medium ${
                            activeTab === 'definitions'
                                ? 'border-primary-500 text-primary-600'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'
                        }`}
                        on:click={() => (activeTab = 'definitions')}
                    >
                        Definitions
                    </button>
                    <button
                        class={`w-1/3 border-b-2 py-4 px-1 text-center text-sm font-medium ${
                            activeTab === 'translations'
                                ? 'border-primary-500 text-primary-600'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'
                        }`}
                        on:click={() => (activeTab = 'translations')}
                    >
                        Translations
                    </button>
                    <button
                        class={`w-1/3 border-b-2 py-4 px-1 text-center text-sm font-medium ${
                            activeTab === 'examples'
                                ? 'border-primary-500 text-primary-600'
                                : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'
                        }`}
                        on:click={() => (activeTab = 'examples')}
                    >
                        Examples
                    </button>
                </nav>
            </div>
            
            <!-- Tab Content -->
            <div class="max-h-[40vh] overflow-y-auto p-6">
                {#if activeTab === 'definitions'}
                    <ul class="space-y-4">
                        {#each definitions as definition, i}
                            <li class="flex">
                                <span class="mr-3 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary-400 to-primary-600 text-xs font-medium text-white shadow-sm">
                                    {i + 1}
                                </span>
                                <span class="text-sm leading-relaxed text-gray-700">{definition}</span>
                            </li>
                        {/each}
                    </ul>
                {:else if activeTab === 'translations'}
                    <div class="space-y-5">
                        {#each Object.entries(translations) as [lang, trans]}
                            <div class="rounded-lg bg-gray-50 p-3">
                                <h4 class="mb-2 flex items-center text-sm font-medium text-gray-900">
                                    <span class="mr-2 inline-block h-2 w-2 rounded-full bg-secondary-500"></span>
                                    {lang}
                                </h4>
                                <ul class="space-y-1 pl-4">
                                    {#each trans as t}
                                        <li class="text-sm text-gray-700">{t}</li>
                                    {/each}
                                </ul>
                            </div>
                        {/each}
                    </div>
                {:else if activeTab === 'examples'}
                    <ul class="space-y-3">
                        {#each examples as example, i}
                            <li class="rounded-lg bg-gradient-to-r from-gray-50 to-white p-4 text-sm leading-relaxed text-gray-700 shadow-sm">
                                <div class="mb-1 text-xs font-medium text-secondary-600">Example {i + 1}</div>
                                {example}
                            </li>
                        {/each}
                    </ul>
                {/if}
            </div>
            
            <!-- Footer -->
            <div class="border-t border-gray-200 bg-gradient-to-r from-secondary-50 to-primary-50 px-6 py-4">
                <div class="flex justify-between">
                    <button
                        type="button"
                        class="relative inline-flex items-center overflow-hidden rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm transition-all duration-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        on:click={onClose}
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        class="group relative inline-flex items-center overflow-hidden rounded-full border border-transparent bg-gradient-to-r from-primary-600 to-secondary-600 px-4 py-2 text-sm font-medium leading-4 text-white shadow-sm transition-all duration-300 hover:from-primary-700 hover:to-secondary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        on:click={onSave}
                    >
                        <span class="absolute -top-10 left-10 h-40 w-40 rounded-full bg-white opacity-10 transition-all duration-700 group-hover:scale-150"></span>
                        <span class="relative flex items-center">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            Save to Collection
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}
