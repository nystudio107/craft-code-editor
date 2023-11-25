type MakeMonacoEditorFn = (elementId: string, fieldType: string, wrapperClass: string, monacoOptions: string, codeEditorOptions: string, endpointUrl: string, placeholderText: string) => import('monaco-editor/esm/vs/editor/editor.api').editor.IStandaloneCodeEditor | undefined;

type SetMonacoEditorLanguageFn = (editor: import('monaco-editor/esm/vs/editor/editor.api').editor.IStandaloneCodeEditor, language: string | undefined, elementId: string) => void;

type SetMonacoEditorThemeFn = (editor: import('monaco-editor/esm/vs/editor/editor.api').editor.IStandaloneCodeEditor, theme: string | undefined) => void;

interface CodeEditorOptions {
  singleLineEditor?: boolean,
  wrapperClass?: string,
  placeholderText?: string,
  displayLanguageIcon?: boolean,
  fileName?: string,
  fixedHeightEditor?: boolean,
  maxEditorRows: number,

  [key: string]: unknown;
}
