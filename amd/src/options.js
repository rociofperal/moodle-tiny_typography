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
 * Editor options for the Tiny Typography plugin.
 *
 * The raw configuration strings are handed over from PHP untouched and parsed
 * on this side, which keeps the option processors to plain strings.
 *
 * @module      tiny_typography/options
 * @copyright   2026 FormaFlow (https://www.formaflow.es), Rocio Fernandez Peral (https://rociofperal.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const fontSizesName = getPluginOptionName(pluginName, 'fontsizes');
const fontFamiliesName = getPluginOptionName(pluginName, 'fontfamilies');
const lineHeightsName = getPluginOptionName(pluginName, 'lineheights');
const canFontSizeName = getPluginOptionName(pluginName, 'canfontsize');
const canFontFamilyName = getPluginOptionName(pluginName, 'canfontfamily');
const canLineHeightName = getPluginOptionName(pluginName, 'canlineheight');

/**
 * Register the options this plugin reads.
 *
 * @param {TinyMCE} editor
 */
export const register = (editor) => {
    const registerOption = editor.options.register;

    registerOption(fontSizesName, {
        processor: 'string',
        "default": '',
    });

    registerOption(fontFamiliesName, {
        processor: 'string',
        "default": '',
    });

    registerOption(lineHeightsName, {
        processor: 'string',
        "default": '',
    });

    registerOption(canFontSizeName, {
        processor: 'boolean',
        "default": true,
    });

    registerOption(canFontFamilyName, {
        processor: 'boolean',
        "default": true,
    });

    registerOption(canLineHeightName, {
        processor: 'boolean',
        "default": true,
    });
};

export const getFontSizes = (editor) => editor.options.get(fontSizesName);
export const getFontFamilies = (editor) => editor.options.get(fontFamiliesName);
export const getLineHeights = (editor) => editor.options.get(lineHeightsName);
export const canUseFontSize = (editor) => editor.options.get(canFontSizeName);
export const canUseFontFamily = (editor) => editor.options.get(canFontFamilyName);
export const canUseLineHeight = (editor) => editor.options.get(canLineHeightName);
