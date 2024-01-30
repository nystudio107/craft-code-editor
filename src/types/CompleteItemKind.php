<?php
/**
 * CodeEditor for Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

namespace nystudio107\codeeditor\types;

/**
 * Based on: https://microsoft.github.io/monaco-editor/api/enums/monaco.languages.completionitemkind.html
 *
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */
abstract class CompleteItemKind
{
    // Constants
    // =========================================================================

    // Faux enum, No proper enums until PHP 8.1, and no constant visibility until PHP 7.1
    public const ClassKind = 5;
    public const ColorKind = 19;
    public const ConstantKind = 14;
    public const ConstructorKind = 2;
    public const CustomcolorKind = 22;
    public const EnumKind = 15;
    public const EnumMemberKind = 16;
    public const EventKind = 10;
    public const FieldKind = 3;
    public const FileKind = 20;
    public const FolderKind = 23;
    public const FunctionKind = 1;
    public const InterfaceKind = 7;
    public const IssueKind = 26;
    public const KeywordKind = 17;
    public const MethodKind = 0;
    public const ModuleKind = 8;
    public const OperatorKind = 11;
    public const PropertyKind = 9;
    public const ReferenceKind = 21;
    public const SnippetKind = 27;
    public const StructKind = 6;
    public const TextKind = 18;
    public const KindParameterKind = 24;
    public const UnitKind = 12;
    public const UserKind = 25;
    public const ValueKind = 13;
    public const VariableKind = 4;
}
