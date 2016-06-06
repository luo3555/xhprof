###XHPROF###
1. ** 编译安装 **
```shell
wget http://pecl.php.net/get/xhprof-0.9.2.tgz
tar zxf xhprof-0.9.2.tgz
cd xhprof-0.9.2/extension/
sudo phpize
./configure --with-php-config=/usr/local/php/bin/php-config
sudo make
sudo make install
```

2. **配置 php.ini**
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
**注:** `如果是64位系统需要将xhprof.so文件拷贝到相关的lib64的目录下`

3. **如果出现错误**　`failed to execute cmd: " dot -Tpng". stderr: sh: 1: dot: not found '`，所以需要先安装graphviz

4. **文件夹结构介绍**
root
|--output  测试输出的结果文件
|
|--public_html XHprof自带的查看测试结果代码根目录，访问这里可以查看结果
|
|--track
|    |--index.php 简化后的测试用文件
|
|--xhprof_lib XHprof 自己的类库

5. **使用介绍**
 - 在`track/index.php`中定义自己**XHPROF_ROOT**的位置
 - 将要测试网站的**index.php**文件改名为**index.php.bak**
 - 讲`track/index.php`放到要测试的网站根目录
 - 如果header中没有自定义｀HTTP_X_XHPROF｀和`HTTP_X_XHPROF_JUMP`这两个字段可以直接将`index.php`中的这两个参数改为`true`
 - 为了动态的开关`XHprof`我们可以安装`Firefox`插件`Modify Headers`来帮助我们实现动态开关
 - 代码地址 [git@github.com:luo3555/xhprof.git](git@github.com:luo3555/xhprof.git)