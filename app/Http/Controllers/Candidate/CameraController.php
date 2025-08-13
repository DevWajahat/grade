<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CameraController extends Controller
{
    public function index($index, $id)
    {


        return view('screens.candidate.camera.index', get_defined_vars());
    }

    public function ocr($index, Request $request, $id)
    {
        try {
            // Validate input
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'required|string'
            ]);

            $images = $request->images;
            $parts = [];


            $systemInstruction = [
                'parts' => [
                    [
                        'text' => 'Extract all handwritten text from the provided images. Combine the text from all images into a single, continuous string. Handle special characters, equations, and diverse handwriting styles accurately. Do not add introductory or concluding phrases. Output only the extracted text.'
                    ]
                ]
            ];


            foreach ($images as $base64Image) {

                if (!preg_match('/^data:image\/(png|jpeg);base64,/', $base64Image, $matches)) {
                    throw new \Exception('Invalid image format for one or more images.');
                }

                $mimeType = 'image/' . $matches[1]; // Dynamically set MIME type (png or jpeg)
                $data = substr($base64Image, strpos($base64Image, ',') + 1);

                $parts[] = [
                    'inlineData' => [
                        'mimeType' => $mimeType,
                        'data' => $data
                    ]
                ];
            }

            $apiUrl = env('OCR_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent');
            $apiKey = env('OCR_API_KEY', env('GEMINI_API'));

            $response = Http::withHeaders([
                'x-goog-api-key' => $apiKey, // Adjust header for xAI API if needed
                'Content-Type' => 'application/json'
            ])->post($apiUrl, [
                'systemInstruction' => $systemInstruction,
                'contents' => [
                    [
                        'parts' => $parts
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'text/plain'
                ]
            ]);

            // Check for API errors
            if ($response->failed()) {
                Log::error('OCR API request failed', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['error' => 'OCR processing failed'], 500);
            }

            // Extract text from response (adjust based on API response structure)
            $extractedText = $response->json('candidates.0.content.parts.0.text', '');

                // dd($extractedText);

                $value = json_encode([
                    'index' => $index,
                    'extracted_text' => $extractedText
                ]);

                // return redirect()->route('candidate.exam.index', $id)->with('ocr',$value);

                return response()->json([
                    'status' => 'true',
                    'message' => 'OCR Text Successfully.',
                    'value' => $value
                ]);

        } catch (\Exception $e) {
            Log::error('OCR processing error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to process images: ' . $e->getMessage()], 400);
        }
    }
}
