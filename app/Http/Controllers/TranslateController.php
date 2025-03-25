<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTranslateRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class TranslateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        return Inertia::render('Translate',
            [
            'message' => $request->string('message')
        ]);
    }


    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'targetLanguage' => 'required|string'
        ]);

        $text = escapeshellarg($request->input('text'));
        $targetLanguage = escapeshellarg($request->input('targetLanguage'));

        $process = new Process([
            'python3', base_path('scripts/translate.py'), $text, $targetLanguage
        ]);

        $process->setTimeout(120); // ⏳ Timeout augmenté à 120 secondes
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // ✅ Récupération de plusieurs suggestions
        $translatedTexts = explode("\n", trim($process->getOutput()));

        return response()->json([
            'translatedTexts' => $translatedTexts
        ]);
    }
}
