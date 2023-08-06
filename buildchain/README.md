# `craft-code-editor` buildchain

This buildchain is a self-contained build system for the `craft-code-editor` JavaScript bundle.

It builds & bundles the Monaco editor and `craft-code-editor` TypeScript code via webpack via a Docker container.

## Prerequisites

- Must have Docker Desktop (or the equivalent) installed

## Commands

This buildchain uses `make` as an interface to the buildchain. The following commands are available:

- `make build` - Build the CodeEditor asset bundle resources into `web/assets/dist`
- `make dev` - Start webpack in watch mode for local development
- `make clean` - Remove `node_modules/` and `package-lock.json` to start clean
- `make npm XXX` - Run an `npm` command inside the container, e.g.: `make npm run lint` or `make npm install`

