<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin information for the Tiny Typography plugin.
 *
 * @package    tiny_typography
 * @copyright  2026 Rocio Fernandez Peral <rocio@rociofperal.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tiny_typography;

use context;
use editor_tiny\editor;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_configuration;
use editor_tiny\plugin_with_menuitems;

/**
 * Tiny Typography plugin information.
 *
 * @package    tiny_typography
 * @copyright  2026 Rocio Fernandez Peral <rocio@rociofperal.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugininfo extends plugin implements
        plugin_with_buttons,
        plugin_with_menuitems,
        plugin_with_configuration {

    /** @var string Default font size scale. Relative units keep user zoom and theme scaling intact. */
    public const DEFAULT_FONT_SIZES = "Extra small=0.75rem\n" .
        "Small=0.875rem\n" .
        "Normal=1rem\n" .
        "Large=1.25rem\n" .
        "Extra large=1.5rem\n" .
        "Heading=2rem";

    /** @var string Default font family list. "inherit" follows whatever the site theme uses. */
    public const DEFAULT_FONT_FAMILIES = "Theme default=inherit\n" .
        "Sans serif=system-ui, -apple-system, \"Segoe UI\", Roboto, Arial, sans-serif\n" .
        "Serif=Georgia, \"Times New Roman\", Times, serif\n" .
        "Monospace=ui-monospace, SFMono-Regular, Consolas, \"Liberation Mono\", monospace\n" .
        "Easy to read=Verdana, Tahoma, Arial, sans-serif";

    /** @var string Default line height list. */
    public const DEFAULT_LINE_HEIGHTS = "Tight=1.15\n" .
        "Normal=1.5\n" .
        "Relaxed=1.75\n" .
        "Double=2";

    /**
     * Buttons this plugin makes available to the toolbar configuration.
     *
     * @return string[]
     */
    public static function get_available_buttons(): array {
        return [
            'tiny_typography/tiny_typography_fontsize',
            'tiny_typography/tiny_typography_fontfamily',
            'tiny_typography/tiny_typography_lineheight',
        ];
    }

    /**
     * Menu items this plugin makes available to the menu configuration.
     *
     * @return string[]
     */
    public static function get_available_menuitems(): array {
        return [
            'tiny_typography/tiny_typography_fontsize',
            'tiny_typography/tiny_typography_fontfamily',
            'tiny_typography/tiny_typography_lineheight',
        ];
    }

    /**
     * Whether the plugin should be loaded at all in this context.
     *
     * If the user cannot use a single one of the controls there is no point in
     * shipping the JavaScript to them.
     *
     * @param context $context
     * @param array $options
     * @param array $fpoptions
     * @param editor|null $editor
     * @return bool
     */
    public static function is_enabled(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): bool {
        return has_capability('tiny/typography:usefontsize', $context)
            || has_capability('tiny/typography:usefontfamily', $context)
            || has_capability('tiny/typography:uselineheight', $context);
    }

    /**
     * Configuration handed to the JavaScript side for this context.
     *
     * The raw admin strings are passed through untouched and parsed in JS, which
     * keeps the option processors simple and avoids any serialisation surprises.
     *
     * @param context $context
     * @param array $options
     * @param array $fpoptions
     * @param editor|null $editor
     * @return array
     */
    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?editor $editor = null
    ): array {
        $config = get_config('tiny_typography');

        $fontsizes = isset($config->fontsizes) && trim($config->fontsizes) !== ''
            ? $config->fontsizes
            : self::DEFAULT_FONT_SIZES;

        $fontfamilies = isset($config->fontfamilies) && trim($config->fontfamilies) !== ''
            ? $config->fontfamilies
            : self::DEFAULT_FONT_FAMILIES;

        $lineheights = isset($config->lineheights) && trim($config->lineheights) !== ''
            ? $config->lineheights
            : self::DEFAULT_LINE_HEIGHTS;

        return [
            'fontsizes' => $fontsizes,
            'fontfamilies' => $fontfamilies,
            'lineheights' => $lineheights,
            'canfontsize' => has_capability('tiny/typography:usefontsize', $context),
            'canfontfamily' => has_capability('tiny/typography:usefontfamily', $context),
            'canlineheight' => has_capability('tiny/typography:uselineheight', $context),
        ];
    }
}
