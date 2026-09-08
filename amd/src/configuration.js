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
 * Tiny Typography configuration.
 *
 * Places the pickers into the editor toolbar and the Format menu.
 *
 * Moodle removes TinyMCE's own font family and font size entries from the Format menu, so this
 * plugin adds its own. It does not add a line height entry, because TinyMCE's one is left in
 * place by Moodle and a second one would only duplicate it. Instead the configured line heights
 * are handed to TinyMCE so that its entry offers the same values as this plugin's toolbar button.
 *
 * @module      tiny_typography/configuration
 * @copyright   2026 Rocio Fernandez Peral <rocio@rociofperal.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {addToolbarSection, addToolbarButtons, addMenubarItem} from 'editor_tiny/utils';
import {
    pluginName,
    fontSizeButtonName,
    fontFamilyButtonName,
    lineHeightButtonName,
} from './common';

const buttons = [
    fontSizeButtonName,
    fontFamilyButtonName,
    lineHeightButtonName,
];

const menuItems = [
    fontSizeButtonName,
    fontFamilyButtonName,
];

const sectionName = 'typography';

/**
 * Pull the plain values out of a configured `Label=value` list.
 *
 * @param {string} raw
 * @returns {Array} The values, in the configured order.
 */
const getValues = (raw) => {
    if (!raw) {
        return [];
    }

    return raw.split(/\r?\n/)
        .map((line) => line.trim())
        .filter((line) => line.indexOf('=') > 0)
        .map((line) => line.slice(line.indexOf('=') + 1).trim())
        .filter((value) => value.length > 0);
};

/**
 * Configure the editor instance.
 *
 * @param {Object} instanceConfig The current editor configuration
 * @param {Object} options The plugin options handed over from PHP
 * @returns {Object} The configuration overrides
 */
export const configure = (instanceConfig, options) => {
    const toolbar = addToolbarSection(instanceConfig.toolbar, sectionName, 'formatting', true);

    const config = {
        toolbar: addToolbarButtons(toolbar, sectionName, buttons),
        menu: addMenubarItem(instanceConfig.menu, 'format', '| ' + menuItems.join(' ')),
    };

    const lineHeights = getValues(options?.plugins?.[pluginName]?.config?.lineheights);
    if (lineHeights.length) {
        // eslint-disable-next-line camelcase
        config.line_height_formats = lineHeights.join(' ');
    }

    return config;
};
