<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\controllers;

use craft\helpers\Json;
use craft\web\Controller;
use nystudio107\codeeditor\CodeEditor;
use yii\web\Response;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class AutocompleteController extends Controller
{
    /**
     * @inheritDoc
     */
    public function beforeAction($action): bool
    {
        if (CodeEditor::$settings->allowFrontendAccess) {
            $this->allowAnonymous = 1;
        }

        return parent::beforeAction($action);
    }

    /**
     * Return all of the autocomplete items in JSON format
     *
     * @param string $fieldType
     * @param string $codeEditorOptions
     * @return Response
     */
    public function actionIndex(string $fieldType = CodeEditor::DEFAULT_FIELD_TYPE, string $codeEditorOptions = ''): Response
    {
        $options = [];
        $parsedJson = Json::decodeIfJson($codeEditorOptions);
        if (is_array($parsedJson)) {
            $options = $parsedJson;
        }
        $result = CodeEditor::getInstance()->autocomplete->generateAutocompletes($fieldType, $options);

        return $this->asJson($result);
    }
}
