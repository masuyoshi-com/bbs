<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>SJ掲示板システム | ログイン</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        echo $this->Html->meta('icon', '/favicon.ico');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('custom');
        echo $this->Html->css('signin');
    ?>
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
    ?>
</head>
<body>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <?php
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->fetch('script');
    ?>
</body>
</html>
