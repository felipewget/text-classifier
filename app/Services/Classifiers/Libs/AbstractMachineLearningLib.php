<?php

namespace App\Services\Classifiers\Libs;

abstract class AbstractMachineLearningLib
{
    abstract public function train(array $samples, array $labels): void;

    abstract public function predict(array $text): string;
}
