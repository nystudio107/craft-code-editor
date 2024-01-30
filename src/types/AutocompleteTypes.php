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
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
abstract class AutocompleteTypes
{
    // Constants
    // =========================================================================

    // Faux enum, No proper enums until PHP 8.1, and no constant visibility until PHP 7.1
    public const TwigExpressionAutocomplete = 'TwigExpressionAutocomplete';
    public const GeneralAutocomplete = 'GeneralAutocomplete';
}
