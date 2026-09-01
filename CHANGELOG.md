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
