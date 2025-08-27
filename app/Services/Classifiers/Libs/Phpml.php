<?php

namespace App\Services\Classifiers\Libs;

use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

class Phpml extends AbstractMachineLearningLib
{
    protected SVC $classifier;
    protected TokenCountVectorizer $vectorizer;

    public function __construct()
    {
        $this->classifier = new SVC(Kernel::LINEAR, $cost = 1000);
        $this->vectorizer = new TokenCountVectorizer(new WordTokenizer());
    }

    public function train(array $samples, array $labels): void
    {
        $this->vectorizer->fit($samples);
        $this->vectorizer->transform($samples);

        $this->classifier->train($samples, $labels);
    }

    public function predict(array $text): string
    {
        $this->vectorizer->transform($text);

        $result = $this->classifier->predict($text);

        return $result[0];
    }
}
