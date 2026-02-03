---
name: ab-devtools
description: Manages component mappings for Askew Brook DevTools. Use when user says "map this component", "add to devtools", "register component", or "update component mapping". Maps HTML element IDs to source files.
---
# DevTools Component Mapping

Map components by adding `id` attributes to Blade views and registering them in `resources/devtools/components.json`.

## Mapping Workflow

1. **Find the component** - Locate the PHP class and Blade view
2. **Add ID to root element** - Use kebab-case: `id="component-name"`
3. **Update components.json** - Add the mapping entry
4. **Report** - Confirm ID added and files modified

## components.json Schema

Location: `resources/devtools/components.json`

```json
{
  "components": {
    "kebab-case-id": {
      "name": "Human Readable Name",
      "files": ["path/to/Class.php", "path/to/view.blade.php"]
    }
  }
}
```

File paths are relative to project root. The `projectRoot` is injected automatically.

## ID Placement Examples

**Filament Pages:**
```blade
<x-filament-panels::page id="page-name">
```

**Livewire/Blade Components:**
```blade
<div id="component-name">
```

## Naming Conventions

- Pages: `page-name` (e.g., `course-builder`)
- Modals: `modal-name` (e.g., `media-picker`)
- Panels: `panel-name` (e.g., `settings-panel`)
- Editors: `editor-name` (e.g., `slide-editor`)
- Cards: `card-name` (e.g., `user-card`)

## Common File Locations

- Filament Pages: `app/Filament/Resources/{Resource}/Pages/{Page}.php`
- Filament Views: `resources/views/filament/pages/{page}/index.blade.php`
- Livewire: `app/Livewire/{Component}.php` + `resources/views/livewire/{component}.blade.php`
- Blade Components: `resources/views/components/{component}.blade.php`

## Tips

- List PHP class first in `files` array
- Include all related files (traits, partials)
- Use Title Case for `name` field
