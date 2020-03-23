<?php
/**
 *  插件设置页面
 */
function wpqiniu_setting_page() {
// 如果当前用户权限不足
	if (!current_user_can('manage_options')) {
		wp_die('Insufficient privileges!');
	}

	$wpqiniu_options = get_option('wpqiniu_options');
	if ($wpqiniu_options && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce']) && !empty($_POST)) {
		if($_POST['type'] == 'cos_info_set') {
			$wpqiniu_options['no_local_file'] = (isset($_POST['no_local_file'])) ? True : False;
			$wpqiniu_options['bucket'] = (isset($_POST['bucket'])) ? sanitize_text_field(trim(stripslashes($_POST['bucket']))) : '';
			$wpqiniu_options['accessKey'] = (isset($_POST['accessKey'])) ? sanitize_text_field(trim(stripslashes($_POST['accessKey']))) : '';
			$wpqiniu_options['secretKey'] = (isset($_POST['secretKey'])) ? sanitize_text_field(trim(stripslashes($_POST['secretKey']))) : '';

			// 不管结果变没变，有提交则直接以提交的数据 更新wpqiniu_options
			update_option('wpqiniu_options', $wpqiniu_options);

			# 替换 upload_url_path 的值
			update_option('upload_url_path', esc_url_raw(trim(trim(stripslashes($_POST['upload_url_path'])))));

			?>
            <div style="font-size: 25px;color: red; margin-top: 20px;font-weight: bold;"><p>WP七牛插件设置保存完毕!!!</p></div>

			<?php

		}
}

?>

    <style>
        table {
            border-collapse: collapse;
        }

        table, td, th {border: 1px solid #cccccc;padding:5px;}
        .buttoncss {background-color: #4CAF50;
            border: none;cursor:pointer;
            color: white;
            padding: 15px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;border-radius: 5px;
            font-size: 12px;font-weight: bold;
        }
        .buttoncss:hover {
            background-color: #008CBA;
            color: white;
        }
        input{border: 1px solid #ccc;padding: 5px 0px;border-radius: 3px;padding-left:5px;}
    </style>
<div style="margin:5px;">
    <h2>WPQiNiu - WordPress + 七牛对象存储设置</h2>
    <hr/>
    
        <p>WordPress 七牛（简称:WPQiNiu），基于七牛云存储与WordPress实现静态资源到对象存储中。提高网站项目的访问速度，以及静态资源的安全存储功能。</p>
        <p>插件网站： <a href="https://www.laobuluo.com" target="_blank">老部落</a> / <a href="https://www.laobuluo.com/2591.html" target="_blank">WPQiNiu发布页面地址</a> / 站长互助QQ群： <a href="https://jq.qq.com/?_wv=1027&k=5gBE7Pt" target="_blank"> <font color="red">594467847</font></a>（宗旨：多做事，少说话，效率至上）</p>
        <p>七牛云存储用户，付费充值可以使用专属优惠码：<font color="red"><b>19345821</b></font>，点击<a href="https://www.itbulu.com/qiniu-recharge.html" target="_blank">查看详细使用指南</a>。</p>
        
   
      <hr/>
    <form action="<?php echo wp_nonce_url('./admin.php?page=' . WPQiNiu_BASEFOLDER . '/actions.php'); ?>" name="wpcosform" method="post">
        <table>
            <tr>
                <td style="text-align:right;">
                    <b>存储空间名称：</b>
                </td>
                <td>
                    <input type="text" name="bucket" value="<?php echo esc_attr($wpqiniu_options['bucket']); ?>" size="50"
                           placeholder="七牛对象存储空间名称"/>

                    <p>1. 需要在七牛云对象存储创建存储空间。</p>
                    <p>2. 示范： <code>laobuluo</code></p>
                </td>
            </tr>

            <tr>
               <td style="text-align:right;">
                    <b>融合CDN加速域名：</b>
              </td>
                <td>
                    <input type="text" name="upload_url_path" value="<?php echo esc_url(get_option('upload_url_path')); ?>" size="50"
                           placeholder="融合CDN加速域名"/>

                    <p><b>设置注意事项：</b></p>

                    <p>1. 输入我们自定义的域名，比如：<code>http（https）://{自定义域名}</code>，不要用"/"结尾。</p>
                    <p>2. 七牛云存储绑定域名需要ICP备案后才可以添加。</p>
                  
                </td>
            </tr>

            <tr>
                <td style="text-align:right;">
                    <b>AccessKey 参数：</b>
                 </td>
                <td><input type="text" name="accessKey" value="<?php echo esc_attr($wpqiniu_options['accessKey']); ?>" size="50" placeholder="accessKey"/></td>
            </tr>
            <tr>
               <td style="text-align:right;">
                    <b>SecretKey 参数：</b>
                 </td>
                <td>
                    <input type="text" name="secretKey" value="<?php echo esc_attr($wpqiniu_options['secretKey']); ?>" size="50" placeholder="secretKey"/>
                    <p>登入 <a href="https://portal.qiniu.com/user/key" target="_blank">密钥管理</a> 可以看到 <code>  AccessKey/SecretKey</code>。如果没有设置的需要创建一组。</p>
                </td>
            </tr>
            <tr>
                <td style="text-align:right;">
                    <b>不在本地保存：</b>
                </td>
                <td>
                    <input type="checkbox"
                           name="no_local_file"
                        <?php
                            if ($wpqiniu_options['no_local_file']) {
                                echo 'checked="TRUE"';
                            }
					    ?>
                    />

                    <p>如果不想同步在服务器中备份静态文件就 "勾选"。我个人喜欢只存储在七牛云存储中，这样缓解服务器存储量。</p>
                </td>
            </tr>
            
            <tr>
                <th>
                    
                </th>
                <td><input type="submit" name="submit" value="保存WordPress七牛对象存储设置" class="buttoncss" /></td>

            </tr>
        </table>
        
        <input type="hidden" name="type" value="cos_info_set">
    </form>
    <p><b>插件注意事项：</b></p>
    <p>1. 如果我们有多个网站需要使用WPQiNiu插件，需要给每一个网站设置一个对象存储，独立空间名。</p>
    <p>2. 使用WPQiNiu插件分离图片、附件文件，存储在七牛云存储空间根目录，比如：2019、2018、2017这样的直接目录，不会有wp-content这样目录。</p>
    <p>3. 如果我们已运行网站需要使用WPQiNiu插件，插件激活之后，需要将本地wp-content目录中的文件对应时间目录上传至七牛存储空间中，且需要在数据库替换静态文件路径生效。</p>
    <p>4. 详细使用教程参考：<a href="https://www.laobuluo.com/2591.html" target="_blank">WPQiNiu发布页面地址</a>，或者加入QQ群： <a href="https://jq.qq.com/?_wv=1027&k=5gBE7Pt" target="_blank"> <font color="red">594467847</font></a>。</p>
</div>
<?php
}
?>