<?php
/**
Plugin Name: WPQiNiu
Plugin URI: https://www.laobuluo.com/2591.html
Description: WordPress同步附件内容远程至七牛云对象存储中，实现网站数据与静态资源分离，提高网站加载速度。站长互助QQ群： <a href="https://jq.qq.com/?_wv=1027&k=5gBE7Pt" target="_blank"> <font color="red">594467847</font></a>
Version: 1.1
Author: 老部落（By:zdl25）
Author URI: https://www.laobuluo.com
*/

require_once 'actions.php';

$current_wp_version = get_bloginfo('version');
# 插件 activation 函数当一个插件在 WordPress 中”activated(启用)”时被触发。
register_activation_hook(__FILE__, 'wpqiniu_set_options');
register_deactivation_hook(__FILE__, 'wpqiniu_restore_options');  # 禁用时触发钩子

# add_action('upgrader_process_complete', 'wpqiniu_upgrade_options');  # 插件升级完成时执行

# 避免上传插件/主题被同步到对象存储
if (substr_count($_SERVER['REQUEST_URI'], '/update.php') <= 0) {
	add_filter('wp_handle_upload', 'wpqiniu_upload_attachments');
	if ( (float)$current_wp_version >= 5.3 ) {
	    add_filter('wp_generate_attachment_metadata', 'wpqiniu_upload_and_thumbs');
	}
}

# 附件更新后触发
if ( (float)$current_wp_version < 5.3 ){
    add_filter( 'wp_update_attachment_metadata', 'wpqiniu_upload_and_thumbs' );
}

# 检测不重复的文件名
add_filter('wp_unique_filename', 'wpqiniu_unique_filename');

# 删除文件时触发删除远端文件，该删除会默认删除缩略图
add_action('delete_attachment', 'wpqiniu_delete_remote_attachment');

# 添加插件设置菜单
add_action('admin_menu', 'wpqiniu_add_setting_page');
add_filter('plugin_action_links', 'wpqiniu_plugin_action_links', 10, 2);
