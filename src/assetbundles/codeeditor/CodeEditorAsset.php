<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\assetbundles\codeeditor;

use craft\web\AssetBundle;
use craft\web\View;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class CodeEditorAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@nystudio107/codeeditor/web/assets/dist';
        $this->depends = [
        ];
        $this->css = [
            'css/vendors.css',
            'css/styles.css',
        ];
        $this->js = [
            'js/runtime.js',
            'js/vendors.js',
            'js/code-editor.js',
        ];

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view): void
    {
        parent::registerAssetFiles($view);

        if ($view instanceof View) {
            $view->registerTranslations('codeeditor', [
                'code is supported.',
            ]);
        }
    }
}
