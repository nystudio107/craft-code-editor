<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\autocompletes;

use nystudio107\codeeditor\base\ObjectParserAutocomplete;
use nystudio107\codeeditor\types\AutocompleteTypes;
use yii\base\BaseObject;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class ObjectAutocomplete extends ObjectParserAutocomplete
{
    // Public Properties
    // =========================================================================

    /**
     * @var string The name of the autocomplete
     */
    public $name = 'ObjectAutocomplete';

    /**
     * @var string The type of the autocomplete
     */
    public $type = AutocompleteTypes::TwigExpressionAutocomplete;

    /**
     * @var bool Whether the autocomplete should be parsed with . -delimited nested sub-properties
     */
    public $hasSubProperties = true;

    /**
     * @var BaseObject The object to parse for autocomplete properties
     */
    public $object = null;

    // Public Methods
    // =========================================================================

    /**
     * @inerhitDoc
     */
    public function generateCompleteItems(): void
    {
        if ($this->object instanceof BaseObject) {
            $this->parseObject('', $this->object, 0);
        }
    }
}
