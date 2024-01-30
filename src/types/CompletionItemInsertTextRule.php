<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\types;

/**
 * Based on: https://microsoft.github.io/monaco-editor/api/enums/monaco.languages.CompletionItemInsertTextRule.html
 *
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
abstract class CompletionItemInsertTextRule
{
    // Constants
    // =========================================================================

    // Faux enum, No proper enums until PHP 8.1, and no constant visibility until PHP 7.1
    public const InsertAsSnippet = 4;
    public const KeepWhitespace = 1;
}
