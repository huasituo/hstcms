<?php

return [
    'title' => 'HSTCMS管理系统',
    'login.title' => '系统登录',
    'manage.systim'=>'管理系统',
    'open.full.screen'=>'开启全屏',
    'close.full.screen'=>'退出全屏',
    'manage.home'=>'后台首页',

    'user.disable' => '用户已禁用',
    'user.disable.log' => '用户已禁用,系统强制退出',
    'ctime.logout' => '超时未操作,系统强制退出',

    'no.username'=>'该账号不存在',

    'founder.disable'=>'禁止',
    'founder.add'=>'添加创始人',
    'founder.edit'=>'更新创始人',
    'founder.user.edit'=>'更新工作人员',
    'founder.delete'=>'删除创始人',
    'founder.user.delete'=>'删除工作人员',
    'founder.delete.my'=>'不能删除自己',
    'founder.one'=>'至少留一位创始人',
    'founder.username.noone'=>'用户名已存在',



    'request.log' => '请求日志',
    'operation.log' => '操作日志',
    'login.log' => '登录日志',
    'safe.setting' => '安全配置',
    'safe.login.ctime' => '登录超时',
    'safe.login.ips' => 'IP限制',
    'safe.login.ips.tips' => '此功能可绑定登录后台的 IP，只有在列表内的 IP 才能登录站点，创始人不受限制。<br>
可以绑定单个IP地址格式如:192.0.0.1，也可以绑定一段IP格式如:192.0.0，多个IP "," 分隔。',
    'safe.update'=>'更新安全配置内容',

    'menu.nav.delete' => '删除权限导航',
    'menu.nav.add' => '添加权限导航',
    'menu.nav.edit' => '更新权限导航',

    'role.uri' => '权限点',
    'role.uri.add' => '添加权限点',
    'role.uri.edit' => '更新权限点',
    'role.uri.delete' => '删除权限点',
    'role.name.empty' => '角色名不能为空',
    'role.name.one' => '角色名已存在',
    'role.edit' => '编辑角色',
    'role.name' => '角色名称',
    'role.delete' => '删除角色',
    'role.delete.error.001' => '该角色正在使用，暂时无法删除',
    'enter.one.role.name' =>'请输入角色名称',
    'select.role' =>'请请选择角色',


    'config.email.update'=>'更新邮箱配置',
    'email.config' =>'邮箱配置',
    'email.test' =>'邮箱测试',
    'email.host' =>'SMTP服务器',
    'email.port' =>'SMTP端口',
    'email.from' =>'发信人地址',
    'email.from.name' =>'发信人昵称',
    'email.auth' =>'SMTP用户身份验证',
    'email.auth.tips' =>'如果SMTP服务器要求通过身份验证才可以发邮件，请选择"开启"。',
    'email.toemail' =>'收件人邮箱',
    'email.toemail.empty' =>'收件人邮箱不能为空',
    'email.toemail.error' =>'收件人邮箱错误',
    'email.content' =>'邮件内容',
    'email.test.content.tips' =>'<p style="height: 20px;line-height: 20px;">标题：测试邮件</p>
                <p style="height: 20px;line-height: 20px;">内容：恭喜您，如果您收到此邮件则代表后台邮件发送设置正确！</p>',
    'email.test.title' =>'测试邮件',
    'email.test.content' =>'恭喜您，如果您收到此邮件则代表后台邮件发送设置正确！',

    'email.test.success' =>'发送测试邮件[成功]',
    'email.test.error' =>'发送测试邮件[失败]',


    'sms.service'=>'短信服务',
    'sms.platform'=>'短信平台',
    'sms.selection.platform'=>'选择平台',
    'sms.setting'=>'短信配置',
    'sms.send.log'=>'发送记录',
    'sms.tiaos'=>'剩余条数',
    'sms.daima'=>'账户代码',
    'sms.key'=>'secret.key',
    'sms.sign'=>'签名ID',
    'sms.purchase'=>'短信购买',
    'sms.hstsmsdaima.empty'=>'账户代码不能为空',
    'sms.hstsmskey.empty'=>'key不能为空',
    'sms.hstsmssign.empty'=>'签名ID不能为空',
    'sms.code.length'=>'验证码长度',
    'sms.code.length.tips'=>'验证码长度不超过10位，默认：6位',
    'sms.product'=>'网站名称',
    'sms.product.tips'=>'网站名称，不允许符合，空格',

    'sms.register.tips'=>'开启后用户注册时需要经过手机号码验证。',
    'sms.login.tips'=>'开启后可以用手机号码登录。',
    'sms.findpw.tips'=>'开启后可以给用户发送短信验证码。',

    'sms.content.r'=>'支持参数：<br>{code}为手机验证码<br>{product}为站点名称',

    'sms.hstsms.seeting'=>'华思拓云短信配置',
    'huasituo.sms'=>'华思拓云短信',
    'huasituo.sms.tips'=>'华思拓云短信，<a href="http://sms.huasituo.com" target="_b">申请</a>',


    'attach.service'=>'附件管理',
    'attach.setting'=>'附件设置',
    'attach.storage'=>'附件存储',
    'attachment.local'=>'本地存储',
    'attachment.ftp'=>'FTP 远程附件存储',
    'storage.dirs'=>'存储目录',
    'storage.dirs.tips'=>'默认：ymd',
    'attachment.extsize'=>'附件类型和尺寸控制',
    'attachment.extsize.tips'=>'系统限制上传单个附件的最大值：',
    'attachment.extsize.tips1'=>'后缀名(小写)',
    'attachment.extsize.tips2'=>'最大值(KB)',
    'attachment.extsize.add'=>'添加附件类型',


    'api.service'=>'Api服务',
    'api.log'=>'请求记录',
    'api.setting'=>'Api配置',
    'api.key'=>'key',
    'api.key.tips'=>'接口key,32位字符串，只允许有：数字、字母（不分大小写）',

];
