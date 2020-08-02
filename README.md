!['logo'](logo.png)

# 精小弘机器人

## 由于酷Q停止运营，项目停止维护

!['php'](https://img.shields.io/packagist/php-v/laravel/laravel)

精小弘机器人由浙江工业大学精弘网络设计的QQ聊天机器人，旨在帮助新生更好适应和了解校园。

使用CoolQ作为QQ驱动的后端，借助 [CQHTTP](https://richardchien.gitee.io/coolq-http-api/docs/) 完成基本通信。

## 进度

### 可用的

   - 词典
   - AI聊天
   - CoolQ接口转发
   - 管理员
   
### 开发中

   - 文档
   - 用户细节配置
   
### 规划中

   - web用户交互

## 安装

使用了Docker技术，让部署变得非常简单

默认情况下设计，如下两个端口

   - nginx :8080
   - mysql :3306
   - novnc :9001
   
使用如下命令启动：

    docker-compose up
    
使用如下命令初始化：
   
    docker-compose run --rm composer update
    docker-compose run --rm npm run dev
    docker-compose run --rm artisan migrate

CoolQ 登录:

打开 ```http://(ip):9001``` 
    
登录vnc 默认密码```MAX8char```

然后登录CoolQ，即可。

## 开发

```/src```   是项目的后端，使用laravel技术

```/ui```   是前端部分，使用react技术
