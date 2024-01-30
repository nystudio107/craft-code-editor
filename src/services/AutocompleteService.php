<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\services;

use Craft;
use craft\base\Component;
use craft\events\SectionEvent;
use craft\services\Fields;
use nystudio107\codeeditor\autocompletes\SectionShorthandFieldsAutocomplete;
use nystudio107\codeeditor\base\Autocomplete;
use nystudio107\codeeditor\base\Autocomplete as BaseAutoComplete;
use nystudio107\codeeditor\CodeEditor;
use nystudio107\codeeditor\events\RegisterCodeEditorAutocompletesEvent;
use yii\base\Event;
use yii\caching\TagDependency;

/**
 * Class Autocomplete
 *
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
class AutocompleteService extends Component
{
    // Constants
    // =========================================================================

    /**
     * @event RegisterCodeEditorAutocompletesEvent The event that is triggered when registering
     *        CodeEditor Autocomplete types
     *
     * Autocomplete Generator types must implement [[AutocompleteInterface]]. [[AutoComplete]]
     * provides a base implementation.
     *
     * ```php
     * use nystudio107\codeeditor\services\AutocompleteService;
     * use nystudio107\codeeditor\events\RegisterCodeEditorAutocompletesEvent;
     * use yii\base\Event;
     *
     * Event::on(AutocompleteService::class,
     *     AutocompleteService::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES,
     *     function(RegisterCodeEditorAutocompletesEvent $event) {
     *         $event->types[] = MyAutocomplete::class;
     *     }
     * );
     *
     * or to pass in a config array for the Autocomplete object:
     *
     * Event::on(AutocompleteService::class,
     *     AutocompleteService::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES,
     *     function(RegisterCodeEditorAutocompletesEvent $event) {
     *         $config = [
     *             'property' => value,
     *         ];
     *         $event->types[] = [MyAutocomplete::class => $config];
     *     }
     * );
     *
     * ```
     */
    public const EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES = 'registerCodeFieldAutocompletes';

    public const AUTOCOMPLETE_CACHE_TAG = 'CodeEditorAutocompleteTag';

    // Public Properties
    // =========================================================================

    /**
     * @var string Prefix for the cache key
     */
    public $cacheKeyPrefix = 'CodeEditorAutocomplete';

    /**
     * @var int Cache duration
     */
    public $cacheDuration = 3600;

    // Public Methods
    // =========================================================================

    /**
     * @inerhitDoc
     */
    public function init(): void
    {
        parent::init();
        // Short cacheDuration if we're in devMode
        if (Craft::$app->getConfig()->getGeneral()->devMode) {
            $this->cacheDuration = 1;
        }
        // Invalidate any SectionShorthandFieldsAutocomplete caches whenever any field layout is edited
        Event::on(Fields::class, Fields::EVENT_AFTER_SAVE_FIELD_LAYOUT, function(SectionEvent $e) {
            $this->clearAutocompleteCache(SectionShorthandFieldsAutocomplete::class);
        });
    }

    /**
     * Call each of the autocompletes to generate their complete items
     * @param string $fieldType
     * @param array $codeEditorOptions
     * @return array
     */
    public function generateAutocompletes(string $fieldType = CodeEditor::DEFAULT_FIELD_TYPE, array $codeEditorOptions = []): array
    {
        $autocompleteItems = [];
        $autocompletes = $this->getAllAutocompleteGenerators($fieldType);
        foreach ($autocompletes as $autocompleteGenerator) {
            /* @var BaseAutoComplete $autocomplete */
            // Assume the generator is a class name string
            $config = [
                'fieldType' => $fieldType,
                'codeEditorOptions' => $codeEditorOptions,
            ];
            $autocompleteClass = $autocompleteGenerator;
            // If we're passed in an array instead, extract the class name and config from the key/value pair
            // in the form of [className => configArray]
            if (is_array($autocompleteGenerator)) {
                $autocompleteClass = array_key_first($autocompleteGenerator);
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $config = array_merge($config, $autocompleteGenerator[$autocompleteClass]);
            }
            $autocomplete = new $autocompleteClass($config);
            $name = $autocomplete->name;
            // Set up the cache parameters
            $cache = Craft::$app->getCache();
            $cacheKey = $this->getAutocompleteCacheKey($autocomplete, $config);
            $dependency = new TagDependency([
                'tags' => [
                    self::AUTOCOMPLETE_CACHE_TAG,
                    self::AUTOCOMPLETE_CACHE_TAG . $name,
                    self::AUTOCOMPLETE_CACHE_TAG . get_class($autocomplete),
                ],
            ]);
            // Get the autocompletes from the cache, or generate them if they aren't cached
            $autocompleteItems[$name] = $cache->getOrSet($cacheKey, static function() use ($name, $autocomplete) {
                $autocomplete->generateCompleteItems();
                return [
                    'name' => $name,
                    'type' => $autocomplete->type,
                    'hasSubProperties' => $autocomplete->hasSubProperties,
                    BaseAutoComplete::COMPLETION_KEY => $autocomplete->getCompleteItems(),
                ];
            }, $this->cacheDuration, $dependency);
        }
        Craft::info('CodeEditor Autocompletes generated', __METHOD__);

        return $autocompleteItems;
    }

    /**
     * Clear the specified autocomplete cache (or all autocomplete caches if left empty)
     *
     * @param string $autocompleteName
     * @return void
     */
    public function clearAutocompleteCache(string $autocompleteName = ''): void
    {
        $cache = Craft::$app->getCache();
        TagDependency::invalidate($cache, self::AUTOCOMPLETE_CACHE_TAG . $autocompleteName);
        Craft::info('CodeEditor caches invalidated', __METHOD__);
    }

    /**
     * Return the cache key to use for an Autocomplete's complete items
     *
     * @param Autocomplete $autocomplete
     * @param array $config
     * @return string
     */
    public function getAutocompleteCacheKey(Autocomplete $autocomplete, array $config): string
    {
        return $this->cacheKeyPrefix . $autocomplete->name . md5(serialize($config));
    }

    // Protected Methods
    // =========================================================================

    /**
     * Returns all available autocompletes classes.
     *
     * @return array The available autocompletes classes
     */
    public function getAllAutocompleteGenerators(string $fieldType = CodeEditor::DEFAULT_FIELD_TYPE): array
    {
        $event = new RegisterCodeEditorAutocompletesEvent([
            'types' => CodeEditor::$settings->defaultCodeEditorAutocompletes,
            'fieldType' => $fieldType,
        ]);
        $this->trigger(self::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES, $event);

        return $event->types;
    }
}
