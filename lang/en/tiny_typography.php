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
 * English strings for the Tiny Typography plugin.
 *
 * @package    tiny_typography
 * @copyright  2026 Rocio Fernandez Peral <rocio@rociofperal.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Tiny Typography';
$string['helplinktext'] = 'Tiny Typography';

// Controls.
$string['fontfamily'] = 'Font family';
$string['fontsize'] = 'Font size';
$string['lineheight'] = 'Line height';
$string['removeformat'] = 'Clear typography';

// Button and menu item labels.
$string['button_fontfamily'] = 'Font family';
$string['button_fontsize'] = 'Font size';
$string['button_lineheight'] = 'Line height';
$string['menuitem_fontfamily'] = 'Font family';
$string['menuitem_fontsize'] = 'Font size';
$string['menuitem_lineheight'] = 'Line height';

// Settings.
$string['settings:fontsizes'] = 'Font sizes';
$string['settings:fontsizes_desc'] = 'One entry per line, written as <em>Label=value</em>. The label is what authors see in the menu and the value is the CSS font size that gets applied. Relative units such as <code>rem</code> are recommended because they respect the reader\'s browser zoom and the theme\'s own scaling; fixed units such as <code>px</code> do not.';
$string['settings:fontfamilies'] = 'Font families';
$string['settings:fontfamilies_desc'] = 'One entry per line, written as <em>Label=font stack</em>. Use <code>inherit</code> as the value to follow the site theme, which keeps authored content looking the same as the rest of the site. Only list fonts your learners are likely to have installed, or the text will fall back to something else on their device.';
$string['settings:lineheights'] = 'Line heights';
$string['settings:lineheights_desc'] = 'One entry per line, written as <em>Label=value</em>. Unitless values such as <code>1.5</code> scale with the font size and are the safest choice.';

// Capabilities.
$string['typography:usefontsize'] = 'Change the font size in the editor';
$string['typography:usefontfamily'] = 'Change the font family in the editor';
$string['typography:uselineheight'] = 'Change the line height in the editor';

// Privacy.
$string['privacy:metadata'] = 'The Tiny Typography plugin does not store any personal data. It only reads the font options configured by the site administrator.';
