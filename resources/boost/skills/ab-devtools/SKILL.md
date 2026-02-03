---
name: ab-devtools
description: Map Laravel components to DevTools for browser-based navigation. Triggers on "map component", "add to devtools", "register for devtools", "devtools mapping". Adds HTML IDs to Blade views and registers them in components.json.
---
# AB DevTools Component Mapping

## Workflow

1. Find the Blade view's root element
2. Add `id="component-name"` (kebab-case)
3. Add entry to `resources/devtools/components.json`
4. Confirm changes

## components.json

```json
{
  "components": {
    "component-id": {
      "name": "Human Readable Name",
      "files": ["app/Path/To/Class.php", "resources/views/path/to/view.blade.php"]
    }
  }
}
```

## ID Naming

| Type | Pattern | Example |
|------|---------|---------|
| Page | `page-*` | `page-dashboard` |
| Modal | `modal-*` | `modal-confirm` |
| Panel | `panel-*` | `panel-settings` |
| Editor | `editor-*` | `editor-content` |
| Card | `card-*` | `card-user` |

## ID Placement

Filament: `<x-filament-panels::page id="page-name">`

Livewire/Blade: `<div id="component-name">`

## File Patterns

- Filament: `app/Filament/**/Pages/*.php` → `resources/views/filament/pages/**/*.blade.php`
- Livewire: `app/Livewire/*.php` → `resources/views/livewire/*.blade.php`
- Blade: `resources/views/components/*.blade.php`
