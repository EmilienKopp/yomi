/**
 * Utility functions for text tokenization
 */

/**
 * Tokenize text using the server-side API
 * 
 * @param {string} text - The text to tokenize
 * @param {string} language - The language code ('en' or 'ja')
 * @returns {Promise<{tokens: string[], count: number}>} - The tokenization result
 */
export async function tokenizeText(text, language = 'en') {
  if (!text || !text.trim()) {
    return { tokens: [], count: 0 };
  }
  
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
      const errorData = await response.json().catch(() => ({}));
      throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Error tokenizing text:', error);
    throw error;
  }
}

/**
 * Simple client-side tokenization for English text
 * Note: This is a basic implementation and should not be used for complex tasks
 * 
 * @param {string} text - The text to tokenize
 * @returns {string[]} - Array of tokens
 */
export function simpleTokenize(text) {
  if (!text || !text.trim()) {
    return [];
  }
  
  // Remove punctuation and split by whitespace
  return text
    .replace(/[^\w\s]/g, ' ')
    .split(/\s+/)
    .filter(Boolean);
}

/**
 * Count tokens in a text (client-side estimation)
 * 
 * @param {string} text - The text to count tokens in
 * @param {string} language - The language code ('en' or 'ja')
 * @returns {number} - Estimated token count
 */
export function estimateTokenCount(text, language = 'en') {
  if (!text || !text.trim()) {
    return 0;
  }
  
  if (language === 'ja') {
    // For Japanese, a very rough estimate (characters / 2)
    // This is not accurate but can be used as a fallback
    return Math.ceil(text.replace(/\s+/g, '').length / 2);
  }
  
  // For English, count words
  return simpleTokenize(text).length;
}
