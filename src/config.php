<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

/**
 * CodeEditor config.php
 *
 * This file exists to store config settings for CodeEditor. This file can
 * be used in place, or it can be put into @craft/config/ as `codeeditor.php`
 *
 * This file is multi-environment aware as well, so you can have different
 * settings groups for each environment, just as you do for `general.php`
 */

use nystudio107\codeeditor\autocompletes\CraftApiAutocomplete;
use nystudio107\codeeditor\autocompletes\SectionShorthandFieldsAutocomplete;
use nystudio107\codeeditor\autocompletes\TwigLanguageAutocomplete;

return [
    // Whether to allow anonymous access be allowed to the codeeditor/autocomplete/index endpoint
    'allowFrontendAccess' => false,
    // Whether to allow frontend templates access to the `codeeditor/codeEditor.twig` Twig template
    'allowTemplateAccess' => true,
    // The default autocompletes to use for the default `CodeEditor` field type
    'defaultCodeEditorAutocompletes' => [
        CraftApiAutocomplete::class,
        TwigLanguageAutocomplete::class,
        SectionShorthandFieldsAutocomplete::class,
    ],
];
