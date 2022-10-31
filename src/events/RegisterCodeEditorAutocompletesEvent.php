<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\events;

use craft\events\RegisterComponentTypesEvent;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class RegisterCodeEditorAutocompletesEvent extends RegisterComponentTypesEvent
{
    /**
     * @var string The type of the field that the autocompletes should be generated for.
     */
    public $fieldType = '';
}
