# Changelog

All notable changes to this plugin are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned
- Import the configured lists from `tiny_fontsize` and `tiny_fontfamily`.
- Normalise pasted content into the configured size scale.
- Minimum font size guard for accessibility.
- PHPUnit and Behat coverage.

## [0.1.6] - 2026-09-08

### Changed
- `amd/build` is now generated with Moodle's own grunt task instead of being written
  by hand. The hand-written files were the cause of the loading bug fixed in 0.1.5.
- The plugin no longer adds its own line height entry to the Format menu. TinyMCE
  already provides one there and Moodle leaves it in place, so a second entry only
  duplicated it. The configured line heights are handed to TinyMCE through
  `line_height_formats`, so the existing menu entry and this plugin's toolbar button
  now offer the same list.

### Added
- README screenshots of the toolbar, the three pickers, the Format menu, the settings
  page and the capabilities.

## [0.1.5] - 2026-09-08

### Fixed
- The compiled `amd/build/plugin.min.js` now returns the promise from the AMD
  factory. Without that return the module resolved to an exports object instead
  of `[pluginName, Configuration]`, so `editor_tiny` filtered the plugin out and
  the pickers never reached the toolbar. No error was raised anywhere.
- The pickers now create their own `typography` toolbar section instead of
  relying on `formatting` existing. `addToolbarButtons` silently discards the
  buttons when the named section is not found.

### Added
- The `tiny/typography:use` capability that Moodle 5.x expects every TinyMCE
  plugin to declare.

### Verified
- Installed and working on Moodle 5.2.2+: pickers render, "Large" produces
  `font-size: 1.25rem`, settings page loads with all three lists.

## [0.1.1] - 2026-09-01

### Fixed
- Added the missing `configuration` module. Without it the pickers were registered
  but never added to the toolbar or the Format menu, so nothing appeared in the
  editor. Verified against Moodle's own `editor_tiny` source.

## [0.1.0] - 2026-09-01

### Added
- Font size picker with a named, relative-unit scale.
- Font family picker with a "Theme default" entry that inherits the site typography.
- Line height picker.
- "Clear typography" action in every picker.
- Three admin-configurable lists (sizes, families, line heights).
- Three independent capabilities, one per control.
- Null privacy provider: the plugin stores no personal data.
