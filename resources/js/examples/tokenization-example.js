/**
 * Example of using the tokenization API from JavaScript
 */

// Function to tokenize text using the API
async function tokenizeText(text, language = 'en') {
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
    return data;
  } catch (error) {
    console.error('Error tokenizing text:', error);
    throw error;
  }
}

// Example usage
document.addEventListener('DOMContentLoaded', () => {
  // Example for English text
  const englishExample = async () => {
    const text = 'Hello world! This is a test.';
    console.log('Tokenizing English text:', text);
    
    try {
      const result = await tokenizeText(text, 'en');
      console.log('English tokenization result:', result);
      console.log('Tokens:', result.tokens);
      console.log('Token count:', result.count);
    } catch (error) {
      console.error('English tokenization failed:', error);
    }
  };

  // Example for Japanese text
  const japaneseExample = async () => {
    const text = 'こんにちは世界！これはテストです。';
    console.log('Tokenizing Japanese text:', text);
    
    try {
      const result = await tokenizeText(text, 'ja');
      console.log('Japanese tokenization result:', result);
      console.log('Tokens:', result.tokens);
      console.log('Token count:', result.count);
    } catch (error) {
      console.error('Japanese tokenization failed:', error);
    }
  };

  // Run examples
  englishExample();
  japaneseExample();
});

// Example of how to use the tokenization in a component
/*
import { onMount } from 'svelte';

let text = 'こんにちは世界！これはテストです。';
let tokens = [];
let isLoading = false;
let error = null;

async function handleTokenize() {
  isLoading = true;
  error = null;
  
  try {
    const result = await tokenizeText(text, 'ja');
    tokens = result.tokens;
  } catch (err) {
    error = err.message;
  } finally {
    isLoading = false;
  }
}

onMount(() => {
  // You could automatically tokenize on component mount
  // handleTokenize();
});
*/
