// The default EditorOptions for the Monaco editor instance
// ref: https://microsoft.github.io/monaco-editor/typedoc/interfaces/editor.IEditorOptions.html
import * as monaco from "monaco-editor";

export const defaultMonacoOptions: monaco.editor.IStandaloneEditorConstructionOptions = {
  language: 'twig',
  theme: 'vs',
  automaticLayout: true,
  tabIndex: 0,
  // Disable sidebar line numbers
  lineNumbers: 'off',
  glyphMargin: false,
  folding: false,
  // Undocumented see https://github.com/Microsoft/vscode/issues/30795#issuecomment-410998882
  lineDecorationsWidth: 0,
  // Disable the current line highlight
  renderLineHighlight: 'none',
  wordWrap: 'on',
  scrollBeyondLastLine: false,
  scrollbar: {
    vertical: 'auto',
    horizontal: 'auto',
    alwaysConsumeMouseWheel: false,
    handleMouseWheel: true,
  },
  fontSize: 14,
  fontFamily: 'SFMono-Regular, Consolas, "Liberation Mono", Menlo, Courier, monospace',
  minimap: {
    enabled: false
  },
};
