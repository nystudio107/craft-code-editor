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

use craft\web\twig\variables\Cp;
use nystudio107\codeeditor\base\Autocomplete;
use nystudio107\codeeditor\models\CompleteItem;
use nystudio107\codeeditor\types\AutocompleteTypes;
use nystudio107\codeeditor\types\CompleteItemKind;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class EnvironmentVariableAutocomplete extends Autocomplete
{
    // Public Properties
    // =========================================================================

    /**
     * @var string The name of the autocomplete
     */
    public $name = 'EnvironmentVariableAutocomplete';

    /**
     * @var string The type of the autocomplete
     */
    public $type = AutocompleteTypes::GeneralAutocomplete;

    /**
     * @var bool Whether the autocomplete should be parsed with . -delimited nested sub-properties
     */
    public $hasSubProperties = false;

    // Public Methods
    // =========================================================================

    /**
     * @inerhitDoc
     */
    public function generateCompleteItems(): void
    {
        $cp = new Cp();
        $suggestions = $cp->getEnvSuggestions(true);
        foreach ($suggestions as $suggestion) {
            foreach ($suggestion['data'] as $item) {
                $name = $item['name'];
                $prefix = $name[0];
                $trimmedName = ltrim($name, $prefix);
                CompleteItem::create()
                    ->label($name)
                    ->insertText($trimmedName)
                    ->filterText($trimmedName)
                    ->detail($item['hint'])
                    ->kind(CompleteItemKind::ConstantKind)
                    ->sortText('~' . $name)
                    ->add($this);
            }
        }
    }
}
