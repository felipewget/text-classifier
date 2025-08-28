<?php

namespace App\Services\Classifiers;

class TextHateDeterctorService extends AbstractClassifier
{
    const HATE_LABEL_RESULT = 'positive';
    
    const SAMPLE_FILENAME = 'samples/text-hate-detector.json';
}
