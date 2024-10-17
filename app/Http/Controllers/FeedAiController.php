<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Log;
use Parsedown;

class FeedAiController extends Controller
{
    public function feedAi(Request $request)
    {
        $queryTitle = $request->input('title');

        Log::debug("queryTitle: ", ['$queryTitle'=>$queryTitle]);
        
        if(empty($queryTitle)){
            return view('pages.ai.generate-feed-ai');
        }

    // Define the API URL and the payload
    $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key='.env('GEMINI_API_KEY');
            
    $payload = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $queryTitle]
                ]
            ]
        ]
    ];

    // Send the POST request
    $response = Http::withHeaders([
        'Content-Type' => 'application/json'
    ])->post($url, $payload);

    // Handle the response and pass it to the view
    if ($response->successful()) {
        $data = $response->json();

        Log::debug("Generate Feed Content", [ 'candidates' => $data['candidates'] ]);

        // dd($data->candidates->content);

        // Initialize Parsedown
        $parsedown = new Parsedown();

        // Convert Markdown to HTML
        if (isset($data['candidates'])) {
            foreach ($data['candidates'] as &$item) {
                if (isset($item['content']['parts'])) {
                    foreach ($item['content']['parts'] as &$part) {
                        $part['text'] = $parsedown->text($part['text']); // Convert to HTML
                    }
                }
            }
        }

        return view('pages.ai.generate-feed-ai', ['data' => $data]);
        } else {
        $error = $response->body();
        return view('pages.ai.generate-feed-ai', ['error' => $error]);
        }


    }
}
