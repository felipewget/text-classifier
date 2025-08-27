<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassifyTextRequest;
use App\Services\Classifiers\Libs\Phpml;
use App\Services\Classifiers\TextEmotionService;
use App\Services\Classifiers\TextHateDeterctorService;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function classify(ClassifyTextRequest $request)
    {
        $phrase = $request->input('phrase');

        $phpml = app(Phpml::class);

        $emotion = (new TextEmotionService($phpml))->predict([$phrase]);
        $hateDetector = (new TextHateDeterctorService($phpml))->predict([$phrase]);

        return response()->json([
            'emotion' => $emotion,
            'is_hate' => $hateDetector,
        ]);
    }
}
