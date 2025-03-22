<script>
  import { onMount } from 'svelte';
  
  let text = '';
  let language = 'en';
  let tokens = [];
  let tokenCount = 0;
  let isLoading = false;
  let error = null;
  
  // Function to tokenize text using the API
  async function tokenizeText() {
    if (!text.trim()) {
      tokens = [];
      tokenCount = 0;
      return;
    }
    
    isLoading = true;
    error = null;
    
    try {
      const response = await fetch('/api/tokenize', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
          text,
          language
        })
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();
      tokens = data.tokens;
      tokenCount = data.count;
    } catch (err) {
      error = err.message;
      tokens = [];
      tokenCount = 0;
    } finally {
      isLoading = false;
    }
  }
  
  // Example texts
  const exampleTexts = {
    en: "Hello world! This is a test of the tokenization service.",
    ja: "こんにちは世界！これはトークン化サービスのテストです。"
  };
  
  function setExampleText() {
    text = exampleTexts[language] || exampleTexts.en;
  }
  
  // When language changes, update the example text
  $: if (language) {
    setExampleText();
  }
  
  onMount(() => {
    setExampleText();
  });
</script>

<div class="text-tokenizer p-6 max-w-4xl mx-auto bg-white rounded-lg shadow-md">
  <h2 class="text-2xl font-bold mb-4">Text Tokenizer</h2>
  
  <div class="mb-4">
    <label class="block text-gray-700 mb-2" for="language">
      Language
    </label>
    <select 
      id="language"
      bind:value={language}
      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
      <option value="en">English</option>
      <option value="ja">Japanese</option>
    </select>
  </div>
  
  <div class="mb-4">
    <label class="block text-gray-700 mb-2" for="text">
      Text to Tokenize
    </label>
    <textarea 
      id="text"
      bind:value={text}
      rows="4"
      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      placeholder="Enter text to tokenize..."
    ></textarea>
  </div>
  
  <div class="flex space-x-2 mb-6">
    <button 
      on:click={tokenizeText}
      class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
      disabled={isLoading || !text.trim()}
    >
      {isLoading ? 'Tokenizing...' : 'Tokenize'}
    </button>
    
    <button 
      on:click={setExampleText}
      class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
    >
      Load Example
    </button>
  </div>
  
  {#if error}
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
      Error: {error}
    </div>
  {/if}
  
  {#if tokens.length > 0}
    <div class="results">
      <h3 class="text-xl font-semibold mb-2">Results ({tokenCount} tokens)</h3>
      
      <div class="token-list p-3 bg-gray-100 rounded-md overflow-x-auto">
        <div class="flex flex-wrap gap-2">
          {#each tokens as token, i}
            <div class="token px-2 py-1 bg-white border border-gray-300 rounded">
              <span class="token-index text-xs text-gray-500">{i + 1}</span>
              <span class="token-text">{token}</span>
            </div>
          {/each}
        </div>
      </div>
    </div>
  {/if}
</div>

<style>
  .text-tokenizer {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  }
  
  .token {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
  }
</style>
