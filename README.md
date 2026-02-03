# Askew Brook DevTools

Laravel package for component mapping. Serves a `/devtools.json` endpoint and includes a Boost skill for AI-assisted mapping.

## Installation

```bash
composer require --dev askewbrook/devtools
```

## Setup

```bash
php artisan vendor:publish --tag=devtools-config
```

Creates `resources/devtools/components.json`.

## Boost Skill

After installing, run `php artisan boost:install` and select the `devtools` skill.

Then use: *"map this component to devtools"* or *"add the sidebar to devtools"*

## Manual Mapping

1. Add `id="component-name"` to a Blade element
2. Register in `resources/devtools/components.json`:

```json
{
  "components": {
    "component-name": {
      "name": "Component Name",
      "files": [
        "app/Livewire/Component.php",
        "resources/views/livewire/component.blade.php"
      ]
    }
  }
}
```

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
