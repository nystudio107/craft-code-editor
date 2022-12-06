# Craft CodeEditor Changelog

All notable changes to this project will be documented in this file.

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
