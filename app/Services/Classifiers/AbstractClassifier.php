<?php

namespace App\Services\Classifiers;

use App\Services\Classifiers\Libs\AbstractMachineLearningLib;

abstract class AbstractClassifier
{
    const SAMPLE_FILENAME = 'samples/text-emotion.json';

    public function __construct(protected AbstractMachineLearningLib $ml)
    {
        $data = $this->loadSample();

        $this->train($data['phrases'], $data['labels']);
    }

    public function predict(array $text): string
    {
        return $this->ml->predict($text);
    }

    private function train(array $samples, array $labels)
    {
        $this->ml->train($samples, $labels);
    }

    private function loadSample(): mixed
    {
        $data = json_decode(file_get_contents(__DIR__ . '\\' . static::SAMPLE_FILENAME), true);

        $phrases = $labels = [];
        foreach ($data as $label => $samples) {
            $phrases = array_merge($phrases, $samples);
            $labels = array_merge($labels, array_fill(0, count($samples), $label));
        }

        return [
            'labels' => $labels,
            'phrases' => $phrases,
        ];
    }
}
