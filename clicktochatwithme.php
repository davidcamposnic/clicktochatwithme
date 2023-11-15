<?php 
 /**
 * Plugin Name: Click to chat with me
 * Plugin URI: https://davidcamposnic.com/plugins/clicktochatwithme/
 * Description: Float WhatsApp Chat: Boost engagement with a sleek chat feature. Connect instantly via WhatsApp and WhatsApp Business with a simple click.
 * Version: 1.0.1
 * Tested up to: 6.0
 * Requires PHP: 7.3.5
 * Author: David Campos
 * Author URI: https://davidcamposnic.com/
 * License: GNU General Public License v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: davidcamposnic
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) die();

// plugin direction url
define('DCNIC_CLICKTOCHAT_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('DCNIC_CLICKTOCHAT_DIRNAME', dirname(__FILE__));

class ClickToChat {
	function __construct($name) {
		$this->name = $name;

		add_action('activate_ecs-chabot/clicktochatwithme.php', array($this, 'onActivate'));
		add_action('admin_menu', array($this, 'adminPage'));
	}

	function languages() {
		load_plugin_textdomain( 'davidcamposnic', false, dirname(plugin_basename(__FILE__)) .'/languages');
	}
	
	function adminPage() {
		$mainPageHook = add_menu_page(
			__('Click To Chat With Me', 'davidcamposnic'), //string $page_title
			__('Click To Chat', 'davidcamposnic'), //string $menu_title
			'manage_options', //string $capability
			'click-to-chat-app', //string $menu_slug
			array($this, 'dashboard_page'), //callable $callback = ''
			'data:image/svg+xml;base64,PCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI0LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluICAtLT4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjkwLjhweCIKCSBoZWlnaHQ9IjE5Ny4ycHgiIHZpZXdCb3g9IjAgMCAyOTAuOCAxOTcuMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjkwLjggMTk3LjI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGRlZnM+CjwvZGVmcz4KPHBhdGggZD0iTTE0Ni45LDQ2LjVsLTguNy0wLjhjLTAuNC0yLjQtMC4xLTUuMy0wLjEtNy44YzAtMy41LTAuMy0yLjgtMy4yLTVjLTE0LjMtMTAuNi02LjctMzAuNyw5LjUtMzIuOQoJYzExLjItMS4xLDIxLjMsMTEuMiwxOC40LDIybC0wLjYsMmMtMS40LDMuNi00LjMsNy45LTgsOS41Yy0zLjMsMS41LTEsOC44LTEuNiwxMy4xTDE0Ni45LDQ2LjV6Ii8+CjxwYXRoIGQ9Ik0yNDUuNCw4NWMtMC4xLTEwLjUtNi0yMS42LTE3LjUtMjJsLTIzLjUsMEw2Ni41LDYzYy0xMC45LDAtMTguNyw0LjQtMjEuMiwxNi4xbC0wLjEsMC40Yy0wLjcsMy4zLTAuMyw3LjMtMC4zLDEwLjdsMCwzNS40CgljMCwyLjctMC4yLDUuNSwwLjEsOC4yYzEuMiwxMC40LDExLjgsOS4zLDE4LjksOS40bDIyLjEsMGwxNDUsMGMxMS4zLDAsMTQuNC0zLjUsMTQuNC0xNEwyNDUuNCw4NXogTTExMSwxMjcuNQoJYy05LjYsMC0xNy41LTcuOC0xNy41LTE3LjVjMC05LjcsNy44LTE3LjUsMTcuNS0xNy41YzkuNywwLDE3LjUsNy44LDE3LjUsMTcuNUMxMjguNSwxMTkuNiwxMjAuNywxMjcuNSwxMTEsMTI3LjV6IE0xNzksMTI3LjUKCWMtOS43LDAtMTcuNS03LjgtMTcuNS0xNy41YzAtOS43LDcuOC0xNy41LDE3LjUtMTcuNWM5LjcsMCwxNy41LDcuOCwxNy41LDE3LjVDMTk2LjUsMTE5LjYsMTg4LjcsMTI3LjUsMTc5LDEyNy41eiIvPgo8cGF0aCBkPSJNMTAuNiwxNjZsLTEuNi0xYy05LTYuMi05LTE1LjEtOS0yNC44bDAtMjcuMWMwLTEwLjcsNC4xLTIwLjgsMTYuMS0yMi44YzMuOC0wLjQsOCwwLjgsOC4xLDUuNEwyNC4xLDE1MwoJYzAsMy4zLDAuMiw2LjcsMCwxMEMyMy44LDE2OS45LDE0LjgsMTY4LDEwLjYsMTY2eiIvPgo8cGF0aCBkPSJNMjgxLjgsMTY0LjdsLTIuMSwxLjNjLTcuOCw0LjEtMTQuMywyLjMtMTQuMy03bDAuMS02Mi4yYzAtMC45LDAuMi0xLjcsMC41LTIuNWwwLjEtMC4zYzEuMS0yLjMsMi44LTMuNCw1LjQtMy44CgljOS45LTAuNSwxNy45LDguNSwxOS4yLDE3LjdjMC4zLDIuMSwwLjIsNC40LDAuMiw2LjZsMCwyNi45QzI5MC44LDE1MSwyOTAuNCwxNTguNCwyODEuOCwxNjQuN3oiLz4KPHBhdGggZD0iTTE4NC43LDE5Ni45Yy0yLjQsMC4xLTQuOCwwLjItNy4yLDAuMmwtNjYuNywwYy04LjcsMC0xMy4yLTAuOS0xMy4xLTExLjNsMC0xMC4xYzAtNy43LTEuNy0xNi40LDguNy0xNy44bDY3LjYtMC4xCgljMy42LDAsOS43LTAuOSwxMi45LDAuN2wxLDAuNWMxLjksMS4xLDMuOSwzLDQuNSw1LjFsMC4xLDAuM2MwLjQsMS41LDAuMiwzLjEsMC4yLDQuNmwwLDE2LjdjMCwxLjcsMC4yLDMuOS0wLjMsNS41bC0wLjMsMC45CglDMTkwLjcsMTk1LjIsMTg3LjgsMTk2LjUsMTg0LjcsMTk2Ljl6Ii8+Cjwvc3ZnPgo=', //string $icon_url
			100 //int|float $position = null
		);

		//Submenu pages
		add_submenu_page(
			'click-to-chat-app', //string $parent_slug
			__('Click To Chat With Me', 'davidcamposnic'), //string $page_title
			__('Dashboard', 'davidcamposnic'), //string $menu_title
			'manage_options', //string $capability
			'click-to-chat-app', //string $menu_slug
			array($this, 'dashboard_page'), //callable $callback = ''
			1 //int|float $position = null
		);
		add_submenu_page( 
			'click-to-chat-app', //string $parent_slug
			__('Options', 'davidcamposnic'), //string $page_title
			__('Options', 'davidcamposnic'), //string $menu_title
			'manage_options', //string $capability
			'click-to-chat-options', //string $menu_slug
			array($this, 'options_page'),
			2 //int|float $position = null
		);
		add_action(
			"load-{$mainPageHook}",
			array($this, 'mainPageAssets')
		);
	}

	function mainPageAssets() {
		$assetsFile = require_once DCNIC_CLICKTOCHAT_DIRNAME . "/build/index.asset.php";
		wp_enqueue_script(
			"decs-script-admin-{$this->name}",
			plugin_dir_url(__FILE__) . "build/index.js",
			$assetsFile['dependencies'],
			$assetsFile['version'],
			true
		);
	}

	function dashboard_page() { ?>
		<div id="dcnicclicktochat-update-me"></div>
  <?php }

	function options_page() { ?>
		<h1>Options</h1>
	<?php }

}

new ClickToChat('chaty');