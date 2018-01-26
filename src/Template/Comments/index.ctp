<?php $this->assign('title', 'コメント一覧'); ?>
<aside class="right-side">
    <section class="content">
    <?= $this->Flash->render() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <h4 class="center">
                                    メンバー名 : <span class="padding-left-10"><?= h($login['username']) ?></span>
                                </h4>
                            </div>
                            <div class="col-lg-7 center callout callout-info">
                                <p style="font-size: 16px;">
                                    選択スレッド:
                                    <?= h($user->username) . '&nbsp; - &nbsp;' . h(tw($thread->title, 130)) ?>
                                </p>
                            </div>
                            <div class="col-lg-2 pull-right">
                            <?= $this->Html->link('<i class="fa fa-sign-out"></i>
                                    <span class="padding-left-5">終了',
                                        ['controller' => 'users', 'action' => 'logout'],
                                        [
                                            'class'   => 'btn bg-maroon col-lg-12',
                                            'escape'  => false,
                                            'confirm' => 'お疲れ様でした。掲示板システムを終了します。',
                                        ])
                            ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                            <?php
                                if (isset($thread_search_uri)) {
                                    echo $this->Html->link('<i class="fa fa-home"></i>
                                    <span class="padding-left-5">親スレッド</span>',
                                        $thread_search_uri,
                                        [
                                            'class'  => 'btn btn-primary col-lg-6',
                                            'escape' => false,
                                        ]
                                    );
                                } else {
                                    echo $this->Html->link('<i class="fa fa-home"></i>
                                    <span class="padding-left-5">親スレッド</span>',
                                        '/',
                                        [
                                            'class'  => 'btn btn-primary col-lg-6',
                                            'escape' => false,
                                        ]
                                    );
                                }
                                
                                echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>
                                <span class="padding-left-5">子スレッド書込み</span>',
                                    ['action' => 'add', h($thread->id)],
                                    [
                                        'class'  => 'btn btn-warning col-lg-6',
                                        'escape' => false
                                    ]
                                );
                            ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-body" >
                        <table class="table table-bordered table-hover table-headerfixed" style="font-size: 16px;">
                            <thead class="bg-navy">
                                <tr>
                                    <th class="ellipsis center width-10">日付</th>
                                    <th class="ellipsis center width-10">時刻</th>
                                    <th class="ellipsis width-25">書き込みメンバー</th>
                                    <th class="ellipsis width-55">メッセージタイトル</th>
                                </tr>
                            </thead>
                            <tbody id="click-highlight" class="table-comment" style="height: 310px;">
                            <?= $this->Form->hidden('login_user_id', ['id' => 'login_user_id', 'value' => h($login['id'])]) ?>
                            <?= $this->Form->hidden('',              ['id' => 'thread_id',     'value' => h($thread->id)]) ?>
                            <?php foreach($comments as $comment): ?>
                                <tr class="cursor-pointer">
                                    <?= $this->Form->hidden('', ['value' => h($comment->id),        'class' => 'comment_id']) ?>
                                    <?= $this->Form->hidden('', ['value' => h($comment->author_id), 'class' => 'author_id']) ?>
                                    <td class="ellipsis center width-10"><?= h($comment->modified->format('m月d日')) ?></td>
                                    <td class="ellipsis center width-10"><?= h($comment->modified->format('H : i')) ?></td>
                                    <td class="ellipsis width-25"><?= h($comment->user->username) ?></td>
                                    <td class="ellipsis width-55"><?= h($comment->title) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= 
                            $this->Form->input('body', [
                                    'id'    => 'text-comment',
                                    'label' => false, 
                                    'type'  => 'textarea', 
                                    'class' => 'form-control margin-top-10',
                                    'rows'  => '15',
                                    'style' => 'font-size: 16px;',
                            ]) 
                        ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
