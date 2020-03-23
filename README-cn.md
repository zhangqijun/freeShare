# 一键博客
**感谢 [urre/wordpress-nginx-docker-compose](https://github.com/urre/wordpress-nginx-docker-compose)**  

使用docker-compose一键搭建博客 [Docker compose](https://docs.docker.com/compose/)

该项目包含以下特征优点:

+ 自定义域名 `myapp.local`
+ nginx配置文件开放 `./nginx`
+ php配置文件开放(去除2mb限制) ./config/php.conf.ini`
+ volumes
+ [PhpMyAdmin](https://www.phpmyadmin.net/) - 网页编辑数据库
+ [Goaccess](https://goaccess.io/) - 实时可交互博客日志.
+ wordpress 好用的插件
    - akismet (反垃圾)
    - wp-githuber-md (markdown编辑器)
    - cryout-serious-slider 
    - kill-429 (中国大陆访问429超时)
    - wp-mail-smtp 
    - enlighter (代码高亮)
    - limit-login-attempts-reloaded 
    - wpqiniu (七牛云存储)
    - Poilive2d (看板娘)
    - xml-sitemap-feed 
+ https脚本
	- 创建https证书脚本
	- 添加macOS系统信任
	- 设置本地host文件

## 设置

### 依赖项

+ [Docker](https://www.docker.com/get-started)
+ Openssl(用于创建证书). 

### 轻松设置初始配置

轻松设置本地域名,密码等配置,参考下节.

#### 样例

复制 `.env-example` 为 `.env` 进行编辑.

样例:

```dotenv
IP=127.0.0.1
APP_NAME=myapp
DOMAIN="myapp.local"
DB_HOST=mysql
DB_NAME=myapp
DB_ROOT_PASSWORD=password
DB_TABLE_PREFIX=wp_

```


### 创建https证书

```shell
cd cli
./create-cert.sh
```

> 注意: 需要安装OpenSSL.

### 设置证书信任

使用脚本使得Chrome 和 Safari信任证书.
> 火狐:选择高级,选择加密标签,点击查看证书,导入您的证书,确认.

```shell
cd cli
./trust-cert.sh
```

### 在本地hosts文件中添加信任

添加后可在浏览器中使用您定义的域名`https://myapp.local`, 在本地文件 `/etc/hosts` 中修改您的自定义域名. `/etc/hosts`文件包含域名到ip的映射.

```shell
cd cli
./setup-hosts-file.sh
```
> 这个脚本可以添加和删除域名映射,根据提示进行操作

## 跑起来

```shell
docker-compose up -d
```

Docker Compose将启动服务

```shell
Creating mysql ... done
Creating phpmyadmin ... done
Creating wordpress  ... done
Creating nginx      ... done
Creating goaccess   ... done
```

查看 [https://myapp.local](https://myapp.local)

## PhpMyAdmin

数据库编辑器可以使用phpmyadmin.

Open [http://127.0.0.1:8080/](http://127.0.0.1:8080/)

## Goaccess

查看日志文件.

Open [http://127.0.0.1:7889/](http://127.0.0.1:7889/)
