<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\base;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
interface ObjectParserInterface
{
    // Public Methods
    // =========================================================================

    /**
     * Parse the object passed in, including any properties or methods
     *
     * @param string $name
     * @param $object
     * @param int $recursionDepth
     * @param string $path
     */
    public function parseObject(string $name, $object, int $recursionDepth, string $path = ''): void;
}
