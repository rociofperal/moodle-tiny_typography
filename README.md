# Tiny Typography

Font size, font family and line height controls for the Moodle TinyMCE editor — in a single plugin, free, GPL, and with no licence key.

## Why this exists

Moodle's default TinyMCE editor does not expose font size or font family controls. Restoring them currently means installing separate plugins for each control, and the actively maintained versions of some of them are behind a paid licence key.

Tiny Typography puts the three controls authors actually ask for into one plugin, with the defaults set the way an accessibility-conscious site would want them.

## What it gives you

- **Font size** picker with a named scale (Small, Normal, Large…) rather than raw numbers.
- **Font family** picker limited to the list the administrator approves.
- **Line height** picker — the one that nobody else offers and every author wants after pasting from Word.
- **Clear typography** action in every picker, which removes what the pickers applied.

## What makes it different

- **Relative units by default.** The shipped scale uses `rem`, so text still responds to the reader's browser zoom and to the theme's own scaling. Fixed `px` sizes break both. You can still configure `px` if you need to.
- **Follows the site theme.** The font family list ships with a `Theme default=inherit` entry, so authored content matches the rest of the site instead of drifting away from it.
- **Named sizes, not numbers.** Teachers do not know whether they want 14 or 16 pixels. They know they want "Large".
- **Per-control capabilities.** Font size, font family and line height are three separate capabilities, so a site can allow one and lock the others. Controls the user is not allowed to use are never registered, and if none are allowed the plugin's JavaScript is not loaded at all.
- **No licence key, no external services, no personal data.**

## Requirements

Moodle 4.1 or later, with the TinyMCE editor enabled.

## Installation

Either install the ZIP from *Site administration → Plugins → Install plugins*, or unpack the folder into `lib/editor/tiny/plugins/typography` inside your Moodle directory and then visit *Site administration → Notifications*.

After installing, add the buttons to the toolbar in *Site administration → Plugins → Text editors → TinyMCE editor*. The three entries are `tiny_typography_fontsize`, `tiny_typography_fontfamily` and `tiny_typography_lineheight`.

## Settings

*Site administration → Plugins → Text editors → TinyMCE editor → Tiny Typography*

Each of the three lists is a plain textarea with one entry per line, written as `Label=value`:

```
Small=0.875rem
Normal=1rem
Large=1.25rem
```

The label is what authors see; the value is the CSS that gets applied. Lines without a separator are ignored rather than shown broken.

## Capabilities

- `tiny/typography:usefontsize`
- `tiny/typography:usefontfamily`
- `tiny/typography:uselineheight`

All three are granted to students, teachers, editing teachers and managers by default, and can be overridden at category or course level.

## Privacy

The plugin stores no personal data. It reads the site configuration and nothing else.

## Roadmap

- Import the configured lists from `tiny_fontsize` and `tiny_fontfamily` so sites can switch over without retyping anything.
- Normalise pasted content — turn the spread of pixel sizes that arrives from Word into the configured scale.
- Minimum font size guard for accessibility.
- Behat coverage.

## Building the JavaScript

The `amd/build` files in this repository are checked in and current, so the plugin works as shipped. If you change anything under `amd/src`, rebuild with Moodle's grunt task:

```
npx grunt amd --root=lib/editor/tiny/plugins/typography
```

## Licence

GNU GPL v3 or later, the same licence as Moodle itself.

## Author

Rocío Fernández Peral — <https://rociofperal.com>
