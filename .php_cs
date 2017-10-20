<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony'                            => true,
        'array_syntax'                        => ['syntax' => 'short'],
        'phpdoc_add_missing_param_annotation' => true,
        'linebreak_after_opening_tag'         => true,
        'phpdoc_annotation_without_dot'       => false,
        'phpdoc_summary'                      => false,
        'phpdoc_no_package'                   => false,
        'phpdoc_order'                        => true,
        'pre_increment'                       => false,
        'phpdoc_align'                        => false,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('./src')
    );

