# bing
通过bing接口抓取壁纸，保存在七牛云存储。通过七牛云外链访问.

#七牛云配置地址
application/config.php

 //七牛云配置
    'qiniuyun'              =>[
        'ACCESSKEY' => '********************',//你的accessKey
        'SECRETKEY' => '****************',//你的secretKey
        'BUCKET' => '******',//上传的空间
        'DOMAIN'=>'********',//空间绑定的域名
    ]
#自动抓取接口
http://your domain/index/api/create_data
(建议定时任务，每日凌晨curl或file_get_content一次即可。)

#demo站
https://api.neweb.top
