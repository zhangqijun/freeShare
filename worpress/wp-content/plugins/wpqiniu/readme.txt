=== WPQiNiu ===

Contributors: laobuluo
Donate link: https://www.laobuluo.com/donate/
Tags:WordPress对象存储,七牛对象存储,七牛云存储WordPress,七牛WordPress,七牛加速WordPress,WordPress加速
Requires at least: 4.5.0
Tested up to: 5.3
Stable tag: 1.1
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

<strong>WordPress 七牛云对象存储（简称:WPQiNiu），基于七牛云对象存储与WordPress实现静态资源到对象存储中，让静态资源包括图片、附件分离WordPress根目录，提高网站打开速度。</strong>

<strong>主要功能：</strong>

* 1、下载和激活【WPQiNiu】插件后，配置API参数和存储空间名称和自定义域名，实现静态资源分离。
* 2、可以选择只存储到七牛云对象存储、也可以本地网站也同时备份。
* 3、七牛云对象存储空间需要绑定自己的域名，且域名需要已经ICP备案才可以接入，需要用到CNAME解析。
* 4、WPQiNiu插件更多详细介绍和安装：<a href="https://www.laobuluo.com/2591.html" target="_blank" >https://www.laobuluo.com/2591.html</a>

<strong>支持网站平台：</strong>

* 1. 老蒋部落 <a href="https://www.itbulu.com" target="_blank" >https://www.itbulu.com</a>
* 2. 老部落 <a href="https://www.laobuluo.com" target="_blank" >https://www.laobuluo.com</a>

== Installation ==

* 1、把wpqiniu文件夹上传到/wp-content/plugins/目录下<br />
* 2、在后台插件列表中激活wpcos<br />
* 3、在左侧【七牛对象存储设置】菜单中输入七牛云对象存储空间名称、自定义域名、API信息。<br />
* 4、设置可以参考：https://www.laobuluo.com/2591.html

== Frequently Asked Questions ==

* 1.当发现插件出错时，开启调试获取错误信息。
* 2.我们可以选择备份对象存储或者本地同时备份。
* 3.如果已有网站使用wpqiniu，插件调试没有问题之后，需要将原有本地静态资源上传到七牛云对象存储中，然后修改数据库原有固定静态文件链接路径。、
* 4.如果不熟悉使用这类插件的用户，一定要先备份，确保错误设置导致网站故障。

== Screenshots ==

1. screenshot-1.png

== Changelog ==

= 0.9 =
* 1. 在完成WPCOS、WPOSS等传统云存储插件之后，有网友呼吁开发一个七牛云对象存储的。
* 2. 根据已有项目的结构和用户体验设计，老赵完成WPQINIU插件的设计。
* 3. 老蒋在插件完成之后，体验实际功能可以确保插件的完整性，但是可能会有与其他插件或者主题冲突。

= 1.0 =
* 1. 检查是否支持WP5.3
* 2. 修复新版本WP5.3的图片处理逻辑

= 1.1 =
* 1. 感觉网友emerge同学提出来解决删除媒体库小图不删除问题

== Upgrade Notice ==
* 