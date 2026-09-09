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
 * Administration settings for the Tiny Typography plugin.
 *
 * @package    tiny_typography
 * @copyright  2026 FormaFlow (https://www.formaflow.es), Rocio Fernandez Peral (https://rociofperal.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use tiny_typography\plugininfo;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtextarea(
        'tiny_typography/fontsizes',
        get_string('settings:fontsizes', 'tiny_typography'),
        get_string('settings:fontsizes_desc', 'tiny_typography'),
        plugininfo::get_default_fontsizes(),
        PARAM_RAW,
        60,
        8
    ));

    $settings->add(new admin_setting_configtextarea(
        'tiny_typography/fontfamilies',
        get_string('settings:fontfamilies', 'tiny_typography'),
        get_string('settings:fontfamilies_desc', 'tiny_typography'),
        plugininfo::get_default_fontfamilies(),
        PARAM_RAW,
        60,
        8
    ));

    $settings->add(new admin_setting_configtextarea(
        'tiny_typography/lineheights',
        get_string('settings:lineheights', 'tiny_typography'),
        get_string('settings:lineheights_desc', 'tiny_typography'),
        plugininfo::get_default_lineheights(),
        PARAM_RAW,
        60,
        6
    ));
}
