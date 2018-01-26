<?php $cakeDescription = 'SJ掲示板システム'; ?>
<?= $this->Html->docType('html5') ?>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <title>
            <?= $cakeDescription ?> |
            <?= $this->fetch('title') ?>
        </title>
        <?php
            echo $this->Html->meta('icon', '/favicon.ico');
            echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
            echo $this->Html->css('bootstrap');
            echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css');
            echo $this->Html->css('ionicons.min');
            echo $this->Html->css('//fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic');
            echo $this->Html->css('CakeAdminLTE');
            echo $this->Html->css('custom');
            echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css');
        ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
    </head>

    <body class="skin-black fixed">
        <?= $this->element('Menu/top_menu') ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
        <?= $this->element('Menu/left_sidebar') ?>
        <?= $this->fetch('content') ?>
        <?php
            echo $this->Html->script('jquery.min');
            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('CakeAdminLTE/app');
            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js');
            echo $this->Html->script('app');
        ?>
        <?= $this->fetch('script') ?>
        <script>
        $(function() {
            initRun.getThread('<?= $this->Url->build("/threads/getbody/") ?>');
            initRun.getComment('<?= $this->Url->build("/comments/getbody/") ?>');
            initRun.dblClickToThreadEdit('<?= $this->Url->build("/threads/edit/") ?>');
            initRun.dblClickToCommentEdit('<?= $this->Url->build("/comments/edit/") ?>');
            initRun.clickToCommentIndex('<?= $this->Url->build("/comments/index/") ?>');
        });
        </script>
    </body>
</html>
