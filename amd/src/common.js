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
 * Shared constants for the Tiny Typography plugin.
 *
 * @module      tiny_typography/common
 * @copyright   2026 FormaFlow (https://www.formaflow.es), Rocio Fernandez Peral (https://rociofperal.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

export const component = 'tiny_typography';
export const pluginName = `${component}/plugin`;

export const fontSizeButtonName = 'tiny_typography_fontsize';
export const fontFamilyButtonName = 'tiny_typography_fontfamily';
export const lineHeightButtonName = 'tiny_typography_lineheight';

export const fontSizeIconName = 'tiny_typography_fontsize_icon';
export const fontFamilyIconName = 'tiny_typography_fontfamily_icon';
export const lineHeightIconName = 'tiny_typography_lineheight_icon';

export const fontSizeIcon = '<svg width="24" height="24" viewBox="0 0 24 24" focusable="false">' +
    '<text x="0" y="19" font-family="sans-serif" font-size="18" fill="currentColor">A</text>' +
    '<text x="13" y="19" font-family="sans-serif" font-size="11" fill="currentColor">A</text>' +
    '</svg>';

export const fontFamilyIcon = '<svg width="24" height="24" viewBox="0 0 24 24" focusable="false">' +
    '<text x="1" y="18" font-family="Georgia, serif" font-size="16" fill="currentColor">Aa</text>' +
    '</svg>';

export const lineHeightIcon = '<svg width="24" height="24" viewBox="0 0 24 24" focusable="false">' +
    '<path fill="currentColor" d="M6 3l2.5 4H6.75v10H8.5L6 21l-2.5-4h1.75V7H3.5z"/>' +
    '<path fill="currentColor" d="M11 5h10v2H11zM11 11h10v2H11zM11 17h10v2H11z"/>' +
    '</svg>';
