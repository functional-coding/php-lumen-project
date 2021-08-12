<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

return (new Config())
    ->setRules([
        '@PhpCsFixer' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
        ],
    ])
    ->setFinder(
        Finder::create()
            ->in(__DIR__.'/app')
            ->in(__DIR__.'/database')
            ->in(__DIR__.'/routes')
            ->in(__DIR__.'/tests')
    )
;
