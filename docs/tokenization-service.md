# Text Tokenization Service

This document provides information on how to use the text tokenization service in the application.

## Overview

The tokenization service provides a simple way to split text into tokens (words). It currently supports:

- English text tokenization (splitting by whitespace and removing punctuation)
- Japanese text tokenization (basic segmentation based on character types and particles)

## Backend API

### Endpoint

```
POST /api/tokenize
```

### Request Parameters

| Parameter | Type   | Required | Description                                |
|-----------|--------|----------|--------------------------------------------|
| text      | string | Yes      | The text to tokenize                       |
| language  | string | No       | The language code ('en' or 'ja', default: 'en') |

### Response Format

```json
{
  "tokens": ["array", "of", "tokens"],
  "count": 3
}
```

### Example Usage

#### cURL

```bash
curl -X POST \
  http://your-app-url/api/tokenize \
  -H 'Content-Type: application/json' \
  -H 'X-CSRF-TOKEN: your-csrf-token' \
  -d '{
    "text": "Hello world! This is a test.",
    "language": "en"
  }'
```

#### PHP

```php
$response = Http::post('/api/tokenize', [
    'text' => 'Hello world! This is a test.',
    'language' => 'en'
]);

$tokens = $response->json()['tokens'];
$count = $response->json()['count'];
```

## Frontend Integration

### JavaScript Utility

You can use the provided JavaScript utility function to tokenize text:

```javascript
// Import the tokenization function
import { tokenizeText } from '@/utils/tokenization';

// Use the function
const result = await tokenizeText('Hello world!', 'en');
console.log(result.tokens); // ['Hello', 'world']
console.log(result.count);  // 2
```

### Svelte Component

A ready-to-use Svelte component is available at `resources/js/Components/TextTokenizer.svelte`:

```svelte
<script>
  import TextTokenizer from '@/Components/TextTokenizer.svelte';
</script>

<TextTokenizer />
```

## Implementation Details

### TokenizationController

The `TokenizationController` handles the API requests and delegates the tokenization to the service.

### TokenizationService

The `TokenizationService` contains the logic for tokenizing text:

- `tokenize(string $text, string $language = 'en'): array` - Main method to tokenize text
- `tokenizeEnglish(string $text): array` - Tokenizes English text
- `tokenizeJapanese(string $text): array` - Tokenizes Japanese text

## Japanese Tokenization

The current implementation uses a simple approach for Japanese tokenization:

1. Removes whitespace
2. Splits by common particles (は, が, の, etc.)
3. Further segments by character type changes (hiragana, katakana, kanji)

This is a basic implementation and may not handle all cases correctly. For production use, consider using a more sophisticated tokenization library like MeCab or Kuromoji.

## Testing

Unit and feature tests are available in the `tests/Feature/TokenizationTest.php` file. Run the tests with:

```bash
php artisan test --filter=TokenizationTest
```

## Future Improvements

- Add support for more languages
- Implement more sophisticated tokenization algorithms
- Add options for stemming, lemmatization, and stop word removal
- Integrate with a machine learning model for better tokenization
