<?php $this->layout = ''; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>エラー</title>
    <?php
        echo $this->Html->meta('icon', '/favicon.ico');
        echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css');
        echo $this->Html->css('ionicons.min');
        echo $this->Html->css('//fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic');
        echo $this->Html->css('CakeAdminLTE');
        echo $this->Html->css('custom');
    ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="well center" style="margin-top: 300px;">
                <h3>
                    <?= $this->Html->image("logo.png", ['alt' => 'スカイジャパングループ']) ?>
                    <span class="margin-10">不正な操作が行われた可能性があります。</span>
                </h3>
                <p>
                <?= $this->Html->link('最初からやり直してください。', '/') ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
