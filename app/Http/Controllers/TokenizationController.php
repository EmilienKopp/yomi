<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TokenizationService;

class TokenizationController extends Controller
{
    protected $tokenizationService;

    public function __construct(TokenizationService $tokenizationService)
    {
        $this->tokenizationService = $tokenizationService;
    }

    /**
     * Tokenize the provided text
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tokenize(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'language' => 'nullable|string|in:en,ja',
        ]);

        $text = $request->input('text');
        $language = $request->input('language', 'en');

        $tokens = $this->tokenizationService->tokenize($text, $language);

        return \response()->json([
            'tokens' => $tokens,
            'count' => \count($tokens),
        ]);
    }
}
