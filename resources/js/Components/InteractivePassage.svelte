<script lang="ts">
    import WordDictionary from "./WordDictionary.svelte";
    
    // Props for the component
    interface Props {
        title?: string;
        content?: string;
        language?: string;
        languageCode?: string;
    }
    
    // Define the dictionary entry type
    interface DictionaryEntry {
        word: string;
        language: string;
        partOfSpeech: string;
        pronunciation: string;
        definitions: string[];
        translations: Record<string, string[]>;
        examples: string[];
    }
    
    // Define the dictionary data type
    type DictionaryData = Record<string, DictionaryEntry>;
    
    // Default props with dummy data
    let {
        title = "A Day in Tokyo",
        content = "東京は日本の首都です。毎日多くの人が東京に来ます。東京には美味しい食べ物、素晴らしい公園、そして興味深い博物館があります。東京タワーからの眺めは素晴らしいです。",
        language = "Japanese",
        languageCode = "ja"
    }: Props = $props();
    
    // State for the dictionary popup
    let selectedWord = $state<DictionaryEntry | null>(null);
    let dictionaryOpen = $state(false);
    
    // Sample dictionary data (in a real app, this would come from an API)
    const dictionaryData: DictionaryData = {
        "東京": {
            word: "東京",
            language: "Japanese",
            partOfSpeech: "noun",
            pronunciation: "とうきょう",
            definitions: ["Tokyo", "capital of Japan"],
            translations: {
                "English": ["Tokyo"],
                "French": ["Tokyo"],
                "Spanish": ["Tokio"]
            },
            examples: [
                "東京は日本の首都です。",
                "東京オリンピックは2021年に開催されました。",
                "東京に住んでいます。"
            ]
        },
        "日本": {
            word: "日本",
            language: "Japanese",
            partOfSpeech: "noun",
            pronunciation: "にほん",
            definitions: ["Japan", "land of the rising sun"],
            translations: {
                "English": ["Japan"],
                "French": ["Japon"],
                "Spanish": ["Japón"]
            },
            examples: [
                "日本は島国です。",
                "日本の文化は独特です。",
                "日本に行ったことがありますか？"
            ]
        },
        "首都": {
            word: "首都",
            language: "Japanese",
            partOfSpeech: "noun",
            pronunciation: "しゅと",
            definitions: ["capital", "capital city"],
            translations: {
                "English": ["capital", "capital city"],
                "French": ["capitale"],
                "Spanish": ["capital"]
            },
            examples: [
                "東京は日本の首都です。",
                "パリはフランスの首都です。",
                "首都圏に住んでいます。"
            ]
        }
    };
    
    // Function to handle word click
    function handleWordClick(word: string): void {
        if (dictionaryData[word]) {
            selectedWord = dictionaryData[word];
            dictionaryOpen = true;
        }
    }
    
    // Function to close dictionary
    function closeDictionary(): void {
        dictionaryOpen = false;
    }
    
    // Function to save word to collection
    function saveWord(): void {
        if (!selectedWord) return;
        
        // In a real app, this would save to the database
        console.log(`Saving word to collection: ${selectedWord.word}`);
        // Show a success message or notification
        alert(`"${selectedWord.word}" added to your collection!`);
        closeDictionary();
    }
    
    // Function to tokenize the content into clickable spans
    // In a real app, this would be more sophisticated with proper tokenization for each language
    function tokenizeContent(text: string): string {
        // Simple tokenization by spaces and punctuation
        // This is a simplified version - real implementation would use proper language-specific tokenization
        const tokens = text.split(/([^\p{L}\p{N}]+)/u);
        return tokens.map((token: string, index: number) => {
            // Check if token is a word (contains letters or numbers)
            const isWord = /[\p{L}\p{N}]+/u.test(token);
            
            if (isWord) {
                const hasDefinition = dictionaryData[token] !== undefined;
                if (hasDefinition) {
                    return `<span 
                        class="relative cursor-pointer inline-block px-0.5 rounded-sm text-primary-700 transition-all duration-300 hover:bg-primary-100 hover:text-primary-900 group" 
                        data-word="${token}"
                    >
                        <span class="absolute -bottom-0.5 left-0 h-0.5 w-full bg-gradient-to-r from-primary-400 to-secondary-400 opacity-50 group-hover:opacity-100 transition-opacity duration-300"></span>
                        ${token}
                    </span>`;
                } else {
                    return `<span>${token}</span>`;
                }
            } else {
                return token;
            }
        }).join('');
    }
</script>

<div class="overflow-hidden rounded-2xl bg-white shadow-soft">
    <!-- Passage Header -->
    <div class="border-b border-gray-200 bg-gradient-to-r from-primary-50 to-secondary-50 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{title}</h2>
                <div class="mt-1 flex items-center text-sm text-gray-500">
                    <span class="rounded-full bg-gradient-to-r from-primary-400 to-primary-600 px-2.5 py-0.5 text-xs font-medium text-white">
                        {language}
                    </span>
                </div>
            </div>
            <div class="hidden h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-accent-400 to-accent-600 text-white sm:flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Passage Content -->
    <div class="p-6">
        <div 
            class="prose prose-sm max-w-none rounded-xl bg-gray-50 p-4 text-gray-700"
            onclick={(e) => {
                const target = e.target as HTMLElement;
                if (target && target.hasAttribute && target.hasAttribute('data-word')) {
                    const word = target.getAttribute('data-word');
                    if (word) {
                        handleWordClick(word);
                    }
                }
            }}
        >
            {@html tokenizeContent(content)}
        </div>
    </div>
    
    <!-- Passage Footer -->
    <div class="border-t border-gray-200 bg-gradient-to-r from-secondary-50 to-primary-50 px-6 py-3">
        <div class="flex justify-between text-sm text-gray-600">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Click on highlighted words to see definitions
            </span>
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                {content.length} characters
            </span>
        </div>
    </div>
    
    <!-- Dictionary Popup -->
    {#if dictionaryOpen && selectedWord}
        <WordDictionary
            word={selectedWord.word}
            language={selectedWord.language}
            partOfSpeech={selectedWord.partOfSpeech}
            pronunciation={selectedWord.pronunciation}
            definitions={selectedWord.definitions}
            translations={selectedWord.translations}
            examples={selectedWord.examples}
            isOpen={dictionaryOpen}
            onClose={closeDictionary}
            onSave={saveWord}
        />
    {/if}
</div>
