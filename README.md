symfony2  simple cms
===========


更新文档
----------------------
git pull origin master #拉取代码

安装静态文件  #(如果修改了css  js 也需要运行下面两步)

- php app/console assets:install
- php app/console  assetic:dump

权限
chmod -R 777 app/cache app/log  