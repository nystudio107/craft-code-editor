# Craft CodeEditor Changelog

All notable changes to this project will be documented in this file.

## 1.0.29 - 2026.01.30
### Fixed
* Roll the version of `monaco-editor` back down to `^0.54.0` to address a seeming regression in `0.55.x` that makes `monaco.languages.json` inaccessible ([#18](https://github.com/nystudio107/craft-code-editor/issues/18))

## 1.0.28 - 2025.12.17
### Fixed
* Bump the version of `monaco-editor` to `^0.55.1` to actually fix the issue with DOMPurify 3.1.7 which is affected by CVE-2025-26791 ([#17](https://github.com/nystudio107/craft-code-editor/issues/17))

## 1.0.27 - 2025.12.13
### Fixed
* Resolved an issue where the bundle used DOMPurify 3.1.7 which is affected by CVE-2025-26791 ([#17](https://github.com/nystudio107/craft-code-editor/issues/17))

### Changed
* Update to use Node 22 & modernize the `buildchain`

## 1.0.26 - 2025.07.28
### Fixed
* Make sure the Monaco editor respects the **Underline links** setting in Craft, so it keeps them underlined if the setting is on

## 1.0.25 - 2025.07.28
### Fixed
* Unless the class `underline-links` was already in the `<body>` tag, remove it because the Monaco editor added it during initialization, and there doesn't appear to be a way to configure the `accessibility.underlineLinks` setting via [IEditorOptions](https://microsoft.github.io/monaco-editor/typedoc/interfaces/editor.IEditorOptions.html) ([#16](https://github.com/nystudio107/craft-code-editor/issues/16))

## 1.0.24 - 2025.07.22
### Fixed
* Update monaco-editor to address DOMPurify 3.0.5 vulnerabilities ([#14](https://github.com/nystudio107/craft-code-editor/issues/14)) via ([#15](https://github.com/nystudio107/craft-code-editor/pull/15))

## 1.0.23 - 2025.05.17
### Fixed
* Dispose of editor models that already exist when making editor ([#13](https://github.com/nystudio107/craft-code-editor/pull/13))

## 1.0.22 - 2024.09.23
### Fixed
* Handle PHP >= 8.1 enums properly

## 1.0.21 - 2024.09.12
### Changed
* Update to `"monaco-editor": "^0.50.0"`

### Fixed
* Removes errors when editing CSS code that contains native CSS nesting or `:has()` selectors [monaco-editor #4071](https://github.com/microsoft/monaco-editor/issues/4071)

## 1.0.20 - 2024.08.21
### Fixed
* Fixed an issue where the autocomplete endpoint could throw a `500` error when attempting to parse properties such as the `sso` property with an insufficient edition of Craft

## 1.0.19 - 2024.04.15
### Added
* Stable release for Craft CMS 5

## 1.0.18 - 2024.03.19
### Fixed
* Fixed an issue that would cause the `SectionShorthandFieldsAutocomplete` to throw an exception if you were running PHP < 8.0 ([#7](https://github.com/nystudio107/craft-code-editor/issues/7))
* Prefix the generated Tailwind CSS (which ironically, we're not using anyway) with `craft-code-editor-` to avoid namespace collisions ([#8](https://github.com/nystudio107/craft-code-editor/issues/8))

## 1.0.17 - 2024.01.29
### Added
* Compatibility with Craft CMS 5
* Add `phpstan` and `ecs` code linting
* Add `code-analysis.yaml` GitHub action

### Changed
* PHPstan code cleanup
* ECS code cleanup

### Fixed
* Use `getSections()` for Craft 3 & 4, and use `getEntries()` for Craft 5

## 1.0.16 - 2023.11.30
### Changed
* Update to `"monaco-editor": "^0.44.0"`

### Fixed
* Fixed an issue where the global `monaco` API object was no longer set properly by the `globalAPI: true` config setting, so we now manually set it on the `window` variable

## 1.0.15 - 2023.11.30
### Fixed
* Fixed a regression that would cause the content height to be set to `50px` by default, when it should be growing to fix the available content

## 1.0.14 - 2023.11.25
### Added
* Added a `maxEditorRows` setting to `CodeEditorOptions` to allow you to control the maximum number of rows before the editor is fixed height, and has a scrollbar
* Update for Craft CMS `^5.0.0-alpha.1`

## 1.0.13 - 2023.08.15
### Added
* Revert checking to see if any models exist before creating them, to allow for multiple instantiation of the same URI... because as implemented, it doesn't allow multiple instances of the editor on the same page

## 1.0.12 - 2023.08.14
### Added
* Check to see if any models exist before creating them, to allow for multiple instantiation of the same URI
* Add `fixedHeightEditor` setting to `CodeEditorOptions` to allow for a scrolling editor in a fixed height frame inherited from the parent container

## 1.0.11 - 2023.08.06
### Added
* Add a `CodeEditorOptions.fileName` so that the name of the file to be edited can be passed down, and used for the `modelUri` so Monaco can auto-detect the correct editor to use based on the file extension

## 1.0.10 - 2023.06.19
### Changed
* The default `lineNumbersMinChars` option value is no longer set to `0`.

## 1.0.9 - 2023.04.16
### Changed
* Updated assets build with the latest deps

## 1.0.8 - 2023.04.12
### Changed
* Add a unique `modelUri` to each editor model

## 1.0.7 - 2022.12.15
### Changed
* Allow scrollbars for text editors instances that are not single line editors
* Set the minimum editor size to the `textarea`'s rows, so you have control over the minimum height of the editor
* Set the maximum number of rows in the editor to 50, after which scrollbars appear

## 1.0.6 - 2022.12.06
### Fixed
* Remove reference to `Craft.` so the JavaScript will work on the frontend

## 1.0.5 - 2022.11.30
### Changed
* Set the default theme before the editor is instantiated, as an optimization

## 1.0.4 - 2022.11.29
### Changed
* Switched to doing tab handling for single line editors via `TabFocus` rather than our own custom tab handler ([ref](https://stackoverflow.com/questions/74202202/how-to-programatically-set-tabfocusmode-in-monaco-editor/74598917#74598917))
* Change the opacity of the placeholder text to make it lighter in appearance

## 1.0.3 - 2022.11.16
### Added
* Added an `allowTemplateAccess` setting to `config.php` to separate frontend template access from frontend autocomplete controller access

### Changed
* Use `--focus-ring` Craft CMS CSS variable for a11y styles

## 1.0.2 - 2022.11.04
### Added
* Added support for `monacoOptions.theme` set to `auto` automatically setting the theme to match the browser's dark mode setting

## 1.0.1 - 2022.11.02
### Added
* Added a JSON icon

### Changed
* Added a default fallback icon if no custom icon is available

## 1.0.0 - 2022.11.01
### Added
* Initial release
