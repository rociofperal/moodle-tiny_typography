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

declare(strict_types=1);

namespace tiny_typography;

use advanced_testcase;
use context_system;

/**
 * Unit tests for the Tiny Typography plugin information class.
 *
 * @package    tiny_typography
 * @covers     \tiny_typography\plugininfo
 * @copyright  2026 FormaFlow (https://www.formaflow.es), Rocio Fernandez Peral (https://rociofperal.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class plugininfo_test extends advanced_testcase {
    /**
     * Start every test from a clean site.
     */
    public function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
    }

    /**
     * Log in as a user who holds exactly the given capabilities at system level.
     *
     * @param string[] $capabilities Capability names to allow. An empty array logs in a user with none of them.
     */
    protected function set_user_with_capabilities(array $capabilities): void {
        $context = context_system::instance();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();

        foreach ($capabilities as $capability) {
            assign_capability($capability, CAP_ALLOW, $roleid, $context->id, true);
        }

        role_assign($roleid, $user->id, $context->id);
        accesslib_clear_all_caches_for_unit_testing();

        $this->setUser($user);
    }

    /**
     * The three controls are offered both to the toolbar and to the menu configuration.
     */
    public function test_the_three_controls_are_offered_to_the_editor(): void {
        $expected = [
            'tiny_typography/tiny_typography_fontsize',
            'tiny_typography/tiny_typography_fontfamily',
            'tiny_typography/tiny_typography_lineheight',
        ];

        $this->assertSame($expected, plugininfo::get_available_buttons());
        $this->assertSame($expected, plugininfo::get_available_menuitems());
    }

    /**
     * With nothing configured the shipped defaults are handed to the editor.
     */
    public function test_configuration_falls_back_to_the_shipped_defaults(): void {
        $this->setAdminUser();

        $config = plugininfo::get_plugin_configuration_for_context(context_system::instance(), [], []);

        $this->assertSame(plugininfo::get_default_fontsizes(), $config['fontsizes']);
        $this->assertSame(plugininfo::get_default_fontfamilies(), $config['fontfamilies']);
        $this->assertSame(plugininfo::get_default_lineheights(), $config['lineheights']);
    }

    /**
     * What the administrator configures is what reaches the editor.
     */
    public function test_configuration_uses_the_configured_lists(): void {
        $this->setAdminUser();

        set_config('fontsizes', "Tiny=0.5rem\nHuge=3rem", 'tiny_typography');
        set_config('fontfamilies', 'Theme default=inherit', 'tiny_typography');
        set_config('lineheights', 'Single=1', 'tiny_typography');

        $config = plugininfo::get_plugin_configuration_for_context(context_system::instance(), [], []);

        $this->assertSame("Tiny=0.5rem\nHuge=3rem", $config['fontsizes']);
        $this->assertSame('Theme default=inherit', $config['fontfamilies']);
        $this->assertSame('Single=1', $config['lineheights']);
    }

    /**
     * A list emptied by the administrator falls back to the default instead of leaving the picker blank.
     */
    public function test_an_emptied_list_falls_back_to_the_default(): void {
        $this->setAdminUser();

        set_config('fontsizes', "   \n  ", 'tiny_typography');

        $config = plugininfo::get_plugin_configuration_for_context(context_system::instance(), [], []);

        $this->assertSame(plugininfo::get_default_fontsizes(), $config['fontsizes']);
    }

    /**
     * Each control is gated by its own capability, so a site can allow one and lock the others.
     */
    public function test_each_control_is_gated_by_its_own_capability(): void {
        $this->set_user_with_capabilities(['tiny/typography:usefontsize']);

        $config = plugininfo::get_plugin_configuration_for_context(context_system::instance(), [], []);

        $this->assertTrue($config['canfontsize']);
        $this->assertFalse($config['canfontfamily']);
        $this->assertFalse($config['canlineheight']);
    }

    /**
     * One allowed control is enough for the plugin to be loaded.
     */
    public function test_the_plugin_is_enabled_when_a_single_control_is_allowed(): void {
        $this->set_user_with_capabilities(['tiny/typography:uselineheight']);

        $this->assertTrue(plugininfo::is_enabled(context_system::instance(), [], []));
    }

    /**
     * With no control allowed the JavaScript is not shipped to the user at all.
     */
    public function test_the_plugin_is_disabled_when_no_control_is_allowed(): void {
        $this->set_user_with_capabilities([]);

        $this->assertFalse(plugininfo::is_enabled(context_system::instance(), [], []));
    }
}
