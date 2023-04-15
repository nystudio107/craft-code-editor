[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/?branch=develop) [![Build Status](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/build-status/develop) [![Code Intelligence Status](https://scrutinizer-ci.com/g/nystudio107/craft-code-editor/badges/code-intelligence.svg?b=develop)](https://scrutinizer-ci.com/code-intelligence)

# Code Editor for Craft CMS 3.x & 4.x

Provides a code editor field with Twig & Craft API autocomplete

![Demo](./resources/code-editor-demo.gif)

## Requirements

Code Editor requires Craft CMS 3.0 or 4.0.

## Installation

To install Code Editor, follow these steps:

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to require the package:

        composer require nystudio107/craft-code-editor

## About Code Editor

Code Editor provides a full-featured code editor with syntax highlighting via the powerful [Monaco Editor](https://microsoft.github.io/monaco-editor/) (the same editor that is the basis for VS Code).

It also can handle hundreds of other code languages, such as [JavaScript](https://github.com/doublesecretagency/craft-cpjs/pull/6), TypeScript, [CSS](https://github.com/doublesecretagency/craft-cpcss/pull/20), Markdown, and a [whole lot more](https://microsoft.github.io/monaco-editor/).

Code Editor provides full autocompletion for [Twig](https://twig.symfony.com/doc/3.x/) filters/functions/tags, and the full [Craft CMS](https://craftcms.com/docs/4.x/) API, including installed plugins:

![Autocomplete](./resources/code-editor-autocomplete.png)

And it adds hover documentation when you hover the cursor over an expression:

![Hovers](./resources/code-editor-hovers.png)

You can also add your own custom Autocompletes, and customize the behavior of the editor.

Code Editor also provides a [Yii2 Validator](https://www.yiiframework.com/doc/guide/2.0/en/tutorial-core-validators) for Twig templates and object templates.

If instead you need a Craft CMS field, use the [Code Field plugin](https://plugins.craftcms.com/codefield), which provides Code Editor wrapped in a field type.

## Using Code Editor

Once you've added the `nystudio107/craft-code-editor` package to your plugin, module, or project, no further setup is needed. This is because it operates as an auto-bootstrapping Yii2 Module.

Code Editor is not a Craft CMS plugin, rather a package to be utilized by a plugin, module, or project.

It can be very easy to add to an existing project, as you can see from the [Preparse field pull request](https://github.com/besteadfast/craft-preparse-field/pull/87) that adds it the [Preparse plugin](https://github.com/besteadfast/craft-preparse-field).

### In the Craft CP

Code Editor works just like the Craft CMS `forms` macros that should be familiar to plugin and module developers.

#### Import Macros

Simply import the macros:

```twig
{% import "codeeditor/codeEditor" as codeEditor %}
```

#### Multi-line Editor

Then to create a `textarea` multi-line editor, do the following:

```twig
{{ codeEditor.textarea({
    id: "myCodeEditor",
    name: "myCodeEditor",
    value: textAreaText,
}) }}
```

...where `textAreaText` is a variable containing the initial text that should be in the editor field. This will create the Twig editor.

To create a `textareaField` multi-line editor, do the following:

```twig
{{ codeEditor.textareaField({
    label: "Twig Editor"|t,
    instructions: "Enter any Twig code below, with full API autocompletion."|t,
    id: "myCodeEditor",
    name: "myCodeEditor",
    value: textAreaText,
}) }}
```

...where `textAreaText` is a variable containing the initial text that should be in the editor field. This will create the `label` and `instructions`, along with the Twig editor.

#### Single-line Editor

Then to create a `text` single-line editor, do the following:

```twig
{{ codeEditor.text({
    id: "myCodeEditor",
    name: "myCodeEditor",
    value: text,
}) }}
```

...where `text` is a variable containing the initial text that should be in the editor field. This will create the Twig editor that is restricted to a single line, for simple Twig expressions.

To create a `textField` single-line editor, do the following:

```twig
{{ codeEditor.textField({
    label: "Twig Editor"|t,
    instructions: "Enter any Twig code below, with full API autocompletion."|t,
    id: "myCodeEditor",
    name: "myCodeEditor",
    value: text,
}) }}
```

...where `text` is a variable containing the initial text that should be in the editor field. This will create the `label` and `instructions`, along with the Twig editor that is restricted to a single line, for simple Twig expressions.

Regardless of the macro used, an Asset Bundle containing the necessary CSS & JavaScript for the editor to function will be included, and the editor initialized.

### In Frontend Templates

Code Editor also works in frontend templates, but you can disable it via the `allowTemplateAccess` config setting. This is enabled by default.

There is also a `allowFrontendAccess` which is disabled by default. This allows access to the `codeeditor/autocomplete/index` endpoint for Twig & Craft API autocompletes. This is disabled by default, so if you want these completions on the frontend, you'll need to specifically enable it.

Do so by copying the `config.php` file to the Craft CMS `config/` directory, renaming the file to `codeeditor.php` in the process, then set the `allowFrontendAccess` setting to `true`:

```php
return [
    // Whether to allow anonymous access be allowed to the codeeditor/autocomplete/index endpoint
    'allowFrontendAccess' => true,
    // Whether to allow frontend templates access to the `codeeditor/codeEditor.twig` Twig template
    'allowTemplateAccess' => true,
    // The default autocompletes to use for the default `CodeEditor` field type
    'defaultCodeEditorAutocompletes' => [
        CraftApiAutocomplete::class,
        TwigLanguageAutocomplete::class,
        SectionShorthandFieldsAutocomplete::class,
    ]
];
```

Then import the macros:

```twig
{% import "codeeditor/codeEditor" as codeEditor %}
```

Create your own `<textarea>` element and include the necessary JavaScript, passing in the `id` of your `textarea` element:

```html
<textarea id="myCodeEditor">
</textarea>
{{ codeEditor.includeJs("myCodeEditor") }}
```

Enabling the `allowFrontendAccess` setting allows access to the `codeeditor/autocomplete/index` endpoint, and add the `codeeditor/templates` directory to the template roots.

The following `monacoOptions` allow you to make the field read-only (though the user can still interact with the code):
```json
{
    "domReadOnly": true,
    "readOnly": true
}
```

### Additional Options

The `textarea`, `textareaField`, `text`, `textField`, and `includeJs` macros all take three additional optional parameters:

```twig
{{ textarea(config, fieldType, editorOptions, codeEditorOptions) }}

{{ textareaField(config, fieldType, editorOptions, codeEditorOptions }}

{{ text(config, fieldType, editorOptions, codeEditorOptions) }}

{{ textField(config, fieldType, editorOptions, codeEditorOptions }}

{{ includeJs(fieldId, fieldType, editorOptions, codeEditorOptions }}
```

#### `fieldType`

**`fieldType`** - an optional 2nd parameter. By default this is set to `Code Editor`. You only need to change it to something else if you're using a custom Autocomplete (see below)

e.g.:

```twig
{{ codeEditor.textarea({
    id: 'myCodeEditor',
    name: 'myCodeEditor',
    value: textAreaText,
}), "MyCustomFieldType" }}
```

#### `editorOptions`

**`editorOptions`** - an optional 4th parameter. This is an [EditorOption](https://microsoft.github.io/monaco-editor/api/interfaces/monaco.editor.IEditorOptions.html) passed in to configure the Monaco editor. By default, this is an empty object.

You would commonly use `editorOptions` to specify the `language` to be used for the Code Editor, or the `theme`, but you can override any [EditorOption](https://microsoft.github.io/monaco-editor/api/interfaces/monaco.editor.IEditorOptions.html) you like.

e.g.:

```twig
{{ codeEditor.textareaField({
    label: "Twig Editor"|t,
    instructions: "Enter any Twig code below, with full API autocompletion."|t,
    id: 'myCodeEditor',
    name: "myCodeEditor",
    value: textAreaText,
    }), "Code Editor", {
        language: "javascript",
        theme: "vs-dark",
    }
}}
```

#### `codeEditorOptions`

**`codeEditorOptions`** - an optional 5th parameter.  This object that can contain any data you want to pass from your Twig template down to the Autocomplete. This can be leveraged in custom Autocompletes to pass contextual for a particular field to the Autocomplete (see below)

e.g.:

```twig
{{ codeEditor.textareaField({
    label: "Twig Editor"|t,
    instructions: "Enter any Twig code below, with full API autocompletion."|t,
    id: "myCodeEditor",
    name: "myCodeEditor",
    value: textAreaText,
    }), "Code Editor", { lineNumbers: "on" }, {
        wrapperClass: "my-css-class another-css-class",
        placeholderText: "Type something!",
   }
}}
```

You can pass in any options you like to `codeEditorOptions` (which might be used in a custom Autocomplete), but the following pre-defined options have a special meaning:

* **`wrapperClass`** - `string` - An additional class that is added to the Code Editor editor wrapper `div`. By default, this is an empty string. The `monaco-editor-background-frame` class is bundled, and will cause the field to look like a Craft CMS editor field, but you can use your own class as well. There also a `monaco-editor-inline-frame` bundled style for an inline editor in a table cell (or elsewhere that no chrome is desired).
* **`singleLineEditor`** - `boolean` - Whether this editor should behave like a single line text field. This is set to `true` for the `text` and `textField` Twig macros, and `false` for the `textarea` and `textareaField` Twig macros.
* **`placeholderText`** - `string` - Placeholder text that should be displayed if the Code Editor field is empty.
* **`displayLanguageIcon`** - `boolean` - Whether the language icon should be displayed in the upper-right corner of the Code Editor, if available.


## Using Additional Autocompletes

Code Editor adds autocompletes only when the editor language is `twig`. The reason is twofold:

* The VScode-derived Monaco editor that powers Code Editor has poor support for Twig, so Code Editor provides Autocompletes for the Twig language
* Craft dynamically adds a raft of functionality to the Twig language in the form of the Craft API, filters, functions, etc. that Code Editor takes care of providing to the Monaco editor

Other languages have more robust support, and come with baked-in autocomplete and syntax highlighting.

By default, Code Editor uses the `CraftApiAutocomplete` & `TwigLanguageAutocomplete`, but it also includes an optional `EnvironmentVariableAutocomplete` which provides autocompletion of any Craft CMS [Environment Variables](https://craftcms.com/docs/4.x/config/#environmental-configuration) and [Aliases](https://craftcms.com/docs/4.x/config/#aliases).

If you want to use the `EnvironmentVariableAutocomplete` or a custom Autocomplete you write, you'll need to add a little PHP code to your plugin, module, or project:

```php
use nystudio107\codeeditor\autocompletes\EnvironmentVariableAutocomplete;
use nystudio107\codeeditor\events\RegisterCodeEditorAutocompletesEvent;
use nystudio107\codeeditor\services\AutocompleteService;

Event::on(
    AutocompleteService::class,
    AutocompleteService::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES,
    function (RegisterCodeEditorAutocompletesEvent $event) {
        $event->types[] = EnvironmentVariableAutocomplete::class;
    }
);
```

The above code will add Environment Variable & Alias autocompletes to all of your Code Editor editors.

However, because you might have several instances of a Code Editor on the same page, and they each may provide separate Autocompletes, you may want to selectively add a custom Autocomplete only when the `fieldType` matches a specific.

Here's an example from the [Sprig plugin](https://github.com/putyourlightson/craft-sprig):

```php
use nystudio107\codeeditor\events\RegisterCodeEditorAutocompletesEvent;
use nystudio107\codeeditor\services\AutocompleteService;
use putyourlightson\sprig\plugin\autocompletes\SprigApiAutocomplete;

public const SPRIG_TWIG_FIELD_TYPE = 'SprigField';

Event::on(
    AutocompleteService::class,
    AutocompleteService::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES,
    function (RegisterCodeEditorAutocompletesEvent $event) {
        if ($event->fieldType === self::SPRIG_TWIG_FIELD_TYPE) {
            $event->types[] = SprigApiAutocomplete::class;
        }
    }
);
```

This ensures that the `SprigApiAutocomplete` Autocomplete will only be added when the `fieldType` passed into the Code Editor macros is set to `SprigField`.

Additionally, you may have an Autocomplete that you want to pass config information down to when it is instantiated. You can accomplish that by adding the Autocomplete as an array:

```php
use nystudio107\codeeditor\autocompletes\CraftApiAutocomplete;
use nystudio107\codeeditor\events\RegisterCodeEditorAutocompletesEvent;
use nystudio107\codeeditor\services\AutocompleteService;

Event::on(
    AutocompleteService::class,
    AutocompleteService::EVENT_REGISTER_CODEEDITOR_AUTOCOMPLETES,
    function (RegisterCodeEditorAutocompletesEvent $event) {
         $config = [
             'additionalGlobals' => $arrayOfVariables,
         ];
        $event->types[] = [CraftApiAutocomplete::class => $config];
    }
);
```

Note that all of the above examples _add_ Autocompletes to the Autocompletes that Code Editor provides by default (`CraftApiAutocomplete` and `TwigLanguageAutocomplete`). If you want to _replace_ them entirely, just empty the `types[]` array first:

```php
        $event->types[] = [];
        $event->types[] = [CraftApiAutocomplete::class => $config];
```

## Writing a Custom Autocomplete

Autocompletes extend from the base [Autocomplete](https://github.com/nystudio107/craft-code-editor/blob/develop/src/base/Autocomplete.php) class, and implement the [AutocompleteInterface](https://github.com/nystudio107/craft-code-editor/blob/develop/src/base/AutocompleteInterface.php)

A simple Autocomplete would look like this:

```php
<?php
namespace myvendor\myname\autocompletes;

use nystudio107\codeeditor\base\Autocomplete;
use nystudio107\codeeditor\models\CompleteItem;
use nystudio107\codeeditor\types\AutocompleteTypes;
use nystudio107\codeeditor\types\CompleteItemKind;

class MyCustomAutocomplete extends Autocomplete
{
    public $name = 'EnvironmentVariableAutocomplete';

    public $type = AutocompleteTypes::GeneralAutocomplete;
    
    public $hasSubProperties = false;

    public function generateCompleteItems(): void
    {
    CompleteItem::create()
        ->label('MyAutocomplete')
        ->insertText('MyAutocomplete')
        ->detail('This is my autocomplete')
        ->documentation('This detailed documentation of my autocomplete')
        ->kind(CompleteItemKind::ConstantKind)
        ->add($this);
    }
}
```

The `$name` property is the name of your Autocomplete, and it is used for the autocomplete cache.

The `$type` property is either `AutocompleteTypes::TwigExpressionAutocomplete` (which only autocompletes inside of a Twig expression) or `AutocompleteTypes::GeneralAutocomplete` (which autocompletes everywhere).

The `$hasSubProperties` property indicates whether your Autocomplete returns nested sub-properties such as `foo.bar.baz`. This hint helps Code Editor present a better autocomplete experience.

`CompleteItem::create()` is a factory method that creates a `CompleteItem` object. You can use the Fluent Model setters as shown above, or you can set properties directly on the model as well. The `CompleteItem::add()` method adds it to the list of generated Autocompletes.

Your Autocomplete also has a `$codeEditorOptions` property which will contain any data passed down via the optional 5th `codeEditorOptions` parameter from your Twig template. This allows you to have contextual information this a particular field.

See the following examples for custom Autocompletes that you can use as a guide when creating your own:

* [TrackingVarsAutocomplete](https://github.com/nystudio107/craft-seomatic/blob/develop/src/autocompletes/TrackingVarsAutocomplete.php)
* [SprigApiAutocomplete](https://github.com/putyourlightson/craft-sprig/blob/develop/src/autocompletes/SprigApiAutocomplete.php)
* [CraftApiAutocomplete](https://github.com/nystudio107/craft-code-editor/blob/develop/src/autocompletes/CraftApiAutocomplete.php)
* [EnvironmentVariableAutocomplete](https://github.com/nystudio107/craft-code-editor/blob/develop/src/autocompletes/EnvironmentVariableAutocomplete.php)
* [TwigLanguageAutocomplete](https://github.com/nystudio107/craft-code-editor/blob/develop/src/autocompletes/TwigLanguageAutocomplete.php)

## Twig Template Validators

Code Editor also includes two Twig template [Validators](https://www.yiiframework.com/doc/guide/2.0/en/tutorial-core-validators) that you can use to validate Twig templates that are saved as part of a model:

* [TwigTemplateValidator](https://github.com/nystudio107/craft-code-editor/blob/develop/src/validators/TwigTemplateValidator.php) - validates the template via `renderString()`
* [TwigObjectTemplateValidator](https://github.com/nystudio107/craft-code-editor/blob/develop/src/validators/TwigObjectTemplateValidator.php) - validates the template via `renderObjectTemplate()`

You just add them as a rule on your model, and it will propagate the model with any errors that were encountered when rendering the template:

```php
use nystudio107\codeeditor\validators\TwigTemplateValidator;

public function defineRules()
{
    return [
        ['myTwigCode', TwigTemplateValidator::class],
    ];
}
```

You can also add in any `variables` that should be presents in the Twig environment:

```php
use nystudio107\codeeditor\validators\TwigTemplateValidator;

public function defineRules()
{
    return [
        [
            'myTwigCode', TwigTemplateValidator::class,
            'variables' => [
               'foo' => 'bar',
           ]
        ],
    ];
}
```

For the `TwigObjectTemplateValidator`, you can also pass in the `object` that should be used when rendering the object template:

```php
use nystudio107\codeeditor\validators\TwigObjectTemplateValidator;

public function defineRules()
{
    return [
        [
            'myTwigCode', TwigObjectTemplateValidator::class, 
            'object' => $object,
            'variables' => [
               'foo' => 'bar',
           ]
        ],
    ];
}
```

## JSON Schema Autocompletes

The Monaco editor that the Code Editor is based on supports [JSON Schema](https://json-schema.org/) for [JSON Autocompletes](https://stackoverflow.com/questions/57461050/setting-diagnostics-json-scheme-in-runtime) that let you define the schema for an JSON editor instance.

You can play with an example of this in the [Monaco playground](https://microsoft.github.io/monaco-editor/playground.html?source=v0.37.1#example-extending-language-services-configure-json-defaults)

Code Editor adds some support to make it a bit easier to do, here's an example from the Craft [Code Field plugin](https://github.com/nystudio107/craft-code-field) on one way to do it via a [Twig template](https://github.com/nystudio107/craft-code-field/blob/develop-v3/src/templates/_components/fields/Code_settings.twig#L162):

```js
{% js %}
// Add schema definitions for this JSON editor field
var jsonSchemaUri = 'https://craft-code-editor.com/{{ "monacoEditorOptions"|namespaceInputId }}';
var jsonSchema = {
  uri: jsonSchemaUri,
  fileMatch: [jsonSchemaUri],
  schema: {{ optionsSchema | raw }}
}
// configure the JSON language support with schemas and schema associations
monaco.languages.json.jsonDefaults.setDiagnosticsOptions({
  validate: true,
  schemas: [jsonSchema]
});
{% endjs %}
```

...where the `optionsSchema` variable is [injected into the template](https://github.com/nystudio107/craft-code-field/blob/develop-v3/src/fields/Code.php#L161), and contains the contents of the [`IEditorOptionsSchema.json`](https://github.com/nystudio107/craft-code-field/blob/develop-v3/src/resources/IEditorOptionsSchema.json) file.

You could alternatively grab this file via an XHR from an Asset Bundle, or just inline the schema definition directly.

## Code Editor Roadmap

Some things to do, and ideas for potential features:

* Add a handler for parsing method return parameters, so we can get autocomplete on things like `craft.app.getSecurity().`
* Figure out why the suggestions details sub-window doesn't appear to size itself properly to fit the `documentation`. It's there, but you have to resize the window to see it, and it appears to be calculated incorrectly somehow
* Smarter Twig expression detection
* Hovers for `TwigExpressionAutocomplete`s should only be added if they are inside of a Twig expression
* It would be nice if `SectionShorthandFieldsAutocomplete` completions presented sub-item completions, too

Brought to you by [nystudio107](https://nystudio107.com/)
