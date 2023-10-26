#XHPROF#

**1. pecl 安装**

```shell
sudo pecl install xhprof
```

**1.1 编译安装**

```shell
wget http://pecl.php.net/get/xhprof-0.9.4.tgz
tar zxf xhprof-0.9.4.tgz
cd xhprof-0.9.4/extension/
sudo phpize
./configure --with-php-config=/usr/local/php/bin/php-config
sudo make
sudo make install
```

**1.2 安装 phpize**
如果本地没有 `phpize` 和 `php-config` 需要单独安装

```shell
sudo apt-get install phpize
sudo apt-get install php-config
```
默认安装如果要安装指定版本需要

```shell
apt-cache search phpize | grep phpize
```
对应自己的 `PHP` 版本查看, 安装自己 `PHP` 对应的版本

```shell
php -v
```

- xhprof PHP 5.x 用版本地址 [http://pecl.php.net/package/xhprof](http://pecl.php.net/package/xhprof)
- xhprof PHP 7.x 用版本地址 [https://github.com/RustJason/xhprof/tree/php7](https://github.com/RustJason/xhprof/tree/php7)
- xhprof PHP 8.x 用版本地址(Pecl) [https://pecl.php.net/package/xhprof](https://pecl.php.net/package/xhprof)


**2. 配置 php.ini**

```ini
[xhprof]
extension=xhprof.so;
; directory used by default implementation of the iXHProfRuns
; interface (namely, the XHProfRuns_Default class) for storing
; XHProf runs.
;
;xhprof.output_dir=<where_you_want_to_save_xhprof_output_file>
xhprof.output_dir=/tmp/xhprof
```
**注意:** 
1. `如果是64位系统需要将xhprof.so文件拷贝到相关的lib64的目录下`
2. `xhprof.output_dir` 对应第四步中的 `output` 文件夹路径

**3. 如果出现错误**　`failed to execute cmd: " dot -Tpng". stderr: sh: 1: dot: not found '`，
所以需要先安装 `graphviz`

**4. 文件夹结构介绍**

root
| -- output  测试输出的结果文件,位置需要配置到 xhprof.output_dir
|
| -- public_html `XHprof自带的查看测试结果代码根目录，访问这里可以查看结果；xhprof 下载解压后得到，将带 xhprof_html 文件夹下的内容拷贝到这里`
|
| -- track
|  | -- index.php 简化后的测试用文件
|
| -- xhprof_lib `XHprof 自己的类库，xhprof 下载解压后得到`



**5. 使用介绍**
 - 在`track/index.php`中定义自己**XHPROF_ROOT**的位置和`XHprof`的域名
 - 将要测试网站的**index.php**文件改名为**index.php.bak**
 - 讲`track/index.php`放到要测试的网站根目录
 - 如果header中没有自定义｀HTTP_XHPROF｀和`HTTP_XHPROF_JUMP`这两个字段可以直接将`index.php`中的这两个参数改为`true`
 - 为了动态的开关`XHprof`我们可以安装`Firefox`插件`Modify Headers`来帮助我们实现动态开关
 - 代码地址 [https://github.com/luo3555/xhprof.git](https://github.com/luo3555/xhprof.git)

