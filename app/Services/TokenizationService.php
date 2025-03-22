<?php

namespace App\Services;

class TokenizationService
{
    /**
     * Tokenize text into an array of words
     *
     * @param string $text The text to tokenize
     * @param string $language The language code (en, ja)
     * @return array
     */
    public function tokenize(string $text, string $language = 'en'): array
    {
        if ($language === 'ja') {
            return $this->tokenizeJapanese($text);
        }

        return $this->tokenizeEnglish($text);
    }

    /**
     * Tokenize English text
     *
     * @param string $text
     * @return array
     */
    private function tokenizeEnglish(string $text): array
    {
        // Remove punctuation and split by whitespace
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);
        $tokens = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        
        return array_values(array_filter($tokens));
    }

    /**
     * Tokenize Japanese text
     *
     * @param string $text
     * @return array
     */
    private function tokenizeJapanese(string $text): array
    {
        // Basic Japanese tokenization
        // This is a simple approach that splits by characters and common particles
        
        // First, normalize the text
        $text = preg_replace('/\s+/u', '', $text); // Remove whitespace
        
        // Split by common particles and punctuation
        $particles = ['は', 'が', 'の', 'に', 'を', 'で', 'と', 'や', 'へ', 'から', 'まで', 'より', 'にて', 'には', 'からは', 'までは', 'よりは'];
        
        // Create a pattern to split by particles
        $pattern = '/(' . implode('|', array_map('preg_quote', $particles)) . ')/u';
        
        // Split the text
        $segments = preg_split($pattern, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        
        // Further segment by character type changes (hiragana, katakana, kanji)
        $tokens = [];
        foreach ($segments as $segment) {
            if (in_array($segment, $particles)) {
                $tokens[] = $segment;
                continue;
            }
            
            // Split by character type changes
            $chars = preg_split('//u', $segment, -1, PREG_SPLIT_NO_EMPTY);
            $currentType = $this->getCharType($chars[0] ?? '');
            $currentToken = $chars[0] ?? '';
            
            for ($i = 1; $i < count($chars); $i++) {
                $type = $this->getCharType($chars[$i]);
                
                // If character type changes, start a new token
                if ($type !== $currentType && !($currentType === 'hiragana' && $type === 'kanji')) {
                    if ($currentToken !== '') {
                        $tokens[] = $currentToken;
                    }
                    $currentToken = $chars[$i];
                    $currentType = $type;
                } else {
                    $currentToken .= $chars[$i];
                }
            }
            
            if ($currentToken !== '') {
                $tokens[] = $currentToken;
            }
        }
        
        return array_values(array_filter($tokens));
    }
    
    /**
     * Determine the character type (hiragana, katakana, kanji, other)
     *
     * @param string $char
     * @return string
     */
    private function getCharType(string $char): string
    {
        if (preg_match('/[\x{3040}-\x{309F}]/u', $char)) {
            return 'hiragana';
        } elseif (preg_match('/[\x{30A0}-\x{30FF}]/u', $char)) {
            return 'katakana';
        } elseif (preg_match('/[\x{4E00}-\x{9FBF}]/u', $char)) {
            return 'kanji';
        } else {
            return 'other';
        }
    }
}
