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
 * Toolbar buttons and menu items for the Tiny Typography plugin.
 *
 * @module      tiny_typography/commands
 * @copyright   2026 Rocio Fernandez Peral <rocio@rociofperal.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getString} from 'core/str';
import {
    component,
    fontSizeButtonName,
    fontFamilyButtonName,
    lineHeightButtonName,
    fontSizeIconName,
    fontFamilyIconName,
    lineHeightIconName,
    fontSizeIcon,
    fontFamilyIcon,
    lineHeightIcon,
} from './common';
import {
    getFontSizes,
    getFontFamilies,
    getLineHeights,
    canUseFontSize,
    canUseFontFamily,
    canUseLineHeight,
} from './options';

/**
 * Turn the admin configuration into a list of choices.
 *
 * Each line looks like "Label=value". Lines without a separator, or with an
 * empty label or value, are skipped rather than shown broken to the author.
 *
 * @param {String} raw
 * @returns {Array} Array of {text, value} objects.
 */
const parseEntries = (raw) => {
    if (!raw) {
        return [];
    }

    return raw.split(/\r?\n/)
        .map((line) => line.trim())
        .filter((line) => line.length > 0 && line.indexOf('=') > 0)
        .map((line) => {
            const separator = line.indexOf('=');
            return {
                text: line.slice(0, separator).trim(),
                value: line.slice(separator + 1).trim(),
            };
        })
        .filter((entry) => entry.text.length > 0 && entry.value.length > 0);
};

export const getSetup = async() => {
    const [
        fontSizeTitle,
        fontFamilyTitle,
        lineHeightTitle,
        clearTitle,
    ] = await Promise.all([
        getString('fontsize', component),
        getString('fontfamily', component),
        getString('lineheight', component),
        getString('removeformat', component),
    ]);

    return (editor) => {
        editor.ui.registry.addIcon(fontSizeIconName, fontSizeIcon);
        editor.ui.registry.addIcon(fontFamilyIconName, fontFamilyIcon);
        editor.ui.registry.addIcon(lineHeightIconName, lineHeightIcon);

        /**
         * Register one picker as both a toolbar button and a menu item.
         *
         * @param {Object} spec
         */
        const addPicker = (spec) => {
            if (!spec.allowed || spec.entries.length === 0) {
                return;
            }

            const buildItems = () => {
                const items = spec.entries.map((entry) => ({
                    type: 'menuitem',
                    text: entry.text,
                    onAction: () => {
                        editor.focus();
                        spec.apply(entry.value);
                    },
                }));

                items.push({type: 'separator'});
                items.push({
                    type: 'menuitem',
                    text: clearTitle,
                    onAction: () => {
                        editor.focus();
                        spec.clear();
                    },
                });

                return items;
            };

            editor.ui.registry.addMenuButton(spec.name, {
                icon: spec.icon,
                tooltip: spec.title,
                fetch: (callback) => callback(buildItems()),
            });

            editor.ui.registry.addNestedMenuItem(spec.name, {
                icon: spec.icon,
                text: spec.title,
                getSubmenuItems: () => buildItems(),
            });
        };

        addPicker({
            name: fontSizeButtonName,
            icon: fontSizeIconName,
            title: fontSizeTitle,
            entries: parseEntries(getFontSizes(editor)),
            allowed: canUseFontSize(editor),
            apply: (value) => editor.execCommand('FontSize', false, value),
            clear: () => editor.formatter.remove('fontsize'),
        });

        addPicker({
            name: fontFamilyButtonName,
            icon: fontFamilyIconName,
            title: fontFamilyTitle,
            entries: parseEntries(getFontFamilies(editor)),
            allowed: canUseFontFamily(editor),
            apply: (value) => editor.execCommand('FontName', false, value),
            clear: () => editor.formatter.remove('fontname'),
        });

        addPicker({
            name: lineHeightButtonName,
            icon: lineHeightIconName,
            title: lineHeightTitle,
            entries: parseEntries(getLineHeights(editor)),
            allowed: canUseLineHeight(editor),
            apply: (value) => editor.execCommand('LineHeight', false, value),
            clear: () => editor.formatter.remove('lineheight'),
        });
    };
};
