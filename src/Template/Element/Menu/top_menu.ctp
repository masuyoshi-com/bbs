<header class="header">
    <?php
        if (isset($thread_search_uri)) {
            echo $this->Html->link('掲示板システム', $thread_search_uri, ['class' => 'logo']);
        } else {
            echo $this->Html->link('掲示板システム', '/', ['class' => 'logo']);
        }
    ?>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-calendar-o"></i><span class="margin-left-10 none">掲示板メニュー</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header bg-navy">掲示板メニュー</li>
                        <li>
                            <ul class="menu">
                                <li>
                                <?php 
                                    if (isset($thread_search_uri)) {
                                        echo $this->Html->link('<h4>掲示板スレッド一覧</h4>
                                            <p>親スレッドを閲覧できます。</p>',
                                                $thread_search_uri,
                                                ['escape' => false]
                                        );
                                    } else {
                                        echo $this->Html->link('<h4>掲示板スレッド一覧</h4>
                                            <p>親スレッドを閲覧できます。</p>',
                                                '/',
                                                ['escape' => false]
                                        );
                                    }
                                ?>
                                </li>
                                <li>
                                <?= 
                                    $this->Html->link('<h4>掲示板スレッド書込み</h4>
                                        <p>親スレッドの新規追加を行います。</p>',
                                            ['controller' => 'threads', 'action' => 'add'],
                                            ['escape' => false]
                                    )
                                ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php if ($login['admin_flag'] === 1) : ?>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i><span class="margin-left-10 none">メンバー管理</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header bg-navy">メンバー管理</li>
                        <li>
                            <ul class="menu">
                                <li>
                                <?php 
                                    if (isset($user_search_uri)) {
                                        echo $this->Html->link('<h4>メンバーリスト</h4>
                                            <p>掲示板利用メンバーを一覧できます。</p>',
                                                $user_search_uri,
                                                ['escape' => false]
                                        );
                                    } else {
                                        echo $this->Html->link('<h4>メンバーリスト</h4>
                                            <p>掲示板利用メンバーを一覧できます。</p>',
                                                ['controller' => 'users', 'action' => 'index'],
                                                ['escape' => false]
                                        );
                                    }
                                ?>
                                </li>
                                <li>
                                <?= 
                                    $this->Html->link('<h4>メンバー新規追加</h4>
                                        <p>掲示板利用メンバーを新規追加します。</p>',
                                            ['controller' => 'users', 'action' => 'add'],
                                            ['escape' => false]
                                    )
                                ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span><?= h($login['name']); ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-body bg-navy">
                            <div class="center">
                            <?= 
                                $this->Html->link('<i class="icon-remove"></i>終了',
                                    [
                                        'admin'      => true,
                                        'controller' => 'users',
                                        'action'     => 'logout',
                                    ], 
                                    [
                                        'escape'  => false,
                                        'class'   => 'btn btn-default btn-flat',
                                        'style'   => 'padding:7px 50px;',
                                        'confirm' => 'お疲れ様でした。掲示板システムを終了します。',
                                    ]
                                )
                            ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
