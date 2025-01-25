<?php

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'blank_line_after_namespace' => true,
    'braces' => [
        'position_after_functions_and_oop_constructs' => 'next',
        'position_after_control_structures' => 'next',
    ],
    'class_definition' => [
        'single_line' => false,
    ],
    'concat_space' => ['spacing' => 'one'],
    'declare_strict_types' => true,
    'function_declaration' => [
        'closure_function_spacing' => 'none',
        'function_argument_spacing' => 'one',
    ],
    'method_argument_space' => [
        'after_heredoc' => true,
        'ensure_fully_multiline' => true,
    ],
    'multiline_whitespace_before_semicolon' => true,
    'no_extra_consecutive_blank_lines' => [
        'tokens' => [
            'extra',
            'throws',
            'use',
            'return',
            'break',
            'continue',
            'echo',
            'function',
            'if',
            'while',
            'for',
            'foreach',
            'try',
            'catch',
        ],
    ],
    'no_unused_imports' => true,
    'phpdoc_align' => ['align' => 'vertical'],
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_types_order' => true,
    'single_trait_insert_per_statement' => true,
    'trailing_comma_in_multiline' => [
        'elements' => ['arrays', 'parameters'],
    ],
])
    ->setRiskyAllowed(true)
    ->setIndent("    ")
    ->setLineEnding("\n")
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude('vendor')
            ->exclude('storage')
            ->exclude('node_modules')
            ->name('*.php')
    );
