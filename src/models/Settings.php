<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\models;

use craft\base\Model;
use craft\validators\ArrayValidator;
use nystudio107\codeeditor\autocompletes\CraftApiAutocomplete;
use nystudio107\codeeditor\autocompletes\SectionShorthandFieldsAutocomplete;
use nystudio107\codeeditor\autocompletes\TwigLanguageAutocomplete;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var bool Whether to allow anonymous access be allowed to the codeeditor/autocomplete/index endpoint
     */
    public $allowFrontendAccess = false;

    /**
     * @var bool Whether to allow frontend templates access to the `codeeditor/codeEditor.twig` Twig template
     */
    public $allowTemplateAccess = true;

    /**
     * @var string[] The default autocompletes to use for the default `CodeEditor` field type
     */
    public $defaultCodeEditorAutocompletes = [
        CraftApiAutocomplete::class,
        TwigLanguageAutocomplete::class,
        SectionShorthandFieldsAutocomplete::class,
    ];

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        return [
            [['allowFrontendAccess', 'allowTemplateAccess'], 'boolean'],
            ['defaultCodeFieldAutocompletes', ArrayValidator::class],
        ];
    }
}
