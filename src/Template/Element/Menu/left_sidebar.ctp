<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="active">
            <?php 
                if (isset($thread_search_uri)) {
                    echo $this->Html->link('<i class="fa fa-calendar-o"></i> <span>掲示板スレッド一覧</span>',
                        $thread_search_uri,
                        ['escape' => false]
                    );
                } else {
                    echo $this->Html->link('<i class="fa fa-calendar-o"></i> <span>掲示板スレッド一覧</span>',
                        '/',
                        ['escape' => false]
                    );
                }
            ?>
            </li>
            <li>
            <?= 
                $this->Html->link('<i class="fa fa-plus"></i> <span>新規スレッド書込み</span>',
                    ['controller' => 'threads', 'action' => 'add'],
                    ['escape' => false]
                )
            ?>
            </li>
            <?php if ($login['admin_flag'] === 1) : ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>メンバー管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                    <?php 
                        if (isset($user_search_uri)) {
                            echo $this->Html->link('<i class="fa fa-angle-double-right"></i>メンバーリスト',
                                $user_search_uri,
                                ['escape' => false]
                            );
                        } else {
                            echo $this->Html->link('<i class="fa fa-angle-double-right"></i>メンバーリスト',
                                ['controller' => 'users', 'action' => 'index'],
                                ['escape' => false]
                            );
                        }
                    ?>
                    </li>
                    <li>
                    <?= 
                        $this->Html->link('<i class="fa fa-angle-double-right"></i>新規メンバー追加',
                            ['controller' => 'users', 'action' => 'add'],
                            ['escape' => false]
                        )
                    ?>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </section><!-- /.sidebar -->
</aside>
