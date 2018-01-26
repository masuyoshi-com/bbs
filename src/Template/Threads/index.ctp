<?php $this->assign('title', 'スレッド一覧'); ?>
<aside class="right-side">
    <section class="content">
    <?= $this->Flash->render() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">メッセージ開始日</span>
                                    <?= $this->Form->create('', ['type' => 'get']) ?>
                                    <?= 
                                        $this->Form->input('from', [
                                                'label' => false,
                                                'id'    => 'datepicker',
                                                'class' => 'form-control',
                                                'style' => 'font-size:18px;'
                                        ])
                                    ?> 
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-xs-12 center">
                                <span style="display: block; padding-top: 7px; font-size:17px;">
                                メンバー名 : &nbsp;&nbsp;<?= h($login['username']) ?>
                                </span>
                            </div>
                            <div class="col-lg-5 pull-right">
                            <?php
                                if ($login['admin_flag'] === 1) {
                                    if (isset($user_search_uri)) {
                                        echo $this->Html->link('<i class="fa fa-users"></i>
                                            <span class="padding-left-5">メンバーリスト</span>',
                                                $user_search_uri, 
                                                [
                                                    'class'  => 'btn btn-default col-lg-4',
                                                    'escape' => false,
                                                ]
                                        );
                                    } else {
                                        echo $this->Html->link('<i class="fa fa-users"></i>
                                            <span class="padding-left-5">メンバーリスト</span>',
                                                ['controller' => 'users', 'action' => 'index'], 
                                                [
                                                    'class'  => 'btn btn-default col-lg-4',
                                                    'escape' => false,
                                                ]
                                        );
                                    }
                                    
                                    echo $this->Html->link('<i class="fa fa-plus"></i>
                                        <span class="padding-left-5">新規メンバー',
                                        ['controller' => 'users', 'action' => 'add'], 
                                        [
                                            'class'  => 'btn btn-default col-lg-4',
                                            'escape' => false,
                                        ]
                                    );
                                    echo $this->Html->link('<i class="fa fa-sign-out"></i>
                                        <span class="padding-left-5">終了',
                                        ['controller' => 'users', 'action' => 'logout'],
                                        [
                                            'class'   => 'btn bg-maroon col-lg-4',
                                            'escape'  => false,
                                            'confirm' => 'お疲れ様でした。掲示板システムを終了します。',
                                        ]
                                    );
                                } else {
                                    echo $this->Html->link('<i class="fa fa-sign-out"></i>
                                        <span class="padding-left-5">サインアウト',
                                        ['controller' => 'users', 'action' => 'logout'],
                                        [
                                            'class'   => 'btn bg-maroon pull-right',
                                            'escape'  => false,
                                            'confirm' => 'お疲れ様でした。掲示板システムを終了します。',
                                        ]
                                    );
                                }
                            ?>
                            </div>
                        </div><!-- /.row -->
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 margin-top-10">
                                <?php 
                                    echo $this->Form->button('<i class="fa fa-refresh"></i>
                                        <span class="padding-left-5">最新情報に更新</span>',
                                        [
                                            'type'   => 'submit',
                                            'class'  => 'btn btn-primary col-lg-4',
                                            'escape' => false,
                                        ]
                                    );
                                    echo $this->Form->button('<i class="fa fa-hand-o-up"></i>
                                        <span class="padding-left-5">スレッド選択</span>',
                                        [
                                            'type'  => 'button',
                                            'id'    => 'thread_select',
                                            'class' => 'btn btn-success col-lg-4',
                                        ]
                                    );
                                    echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>
                                        <span class="padding-left-5">スレッド書込み</span>', 
                                        ['action' => 'add'],
                                        ['class'  => 'btn btn-warning col-lg-4', 'escape' => false]
                                    );
                                ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 margin-top-10">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-4 no-padding">
                                        <?= 
                                            $this->Form->input('keyword', [
                                                    'label'       => false,
                                                    'class'       => 'form-control',
                                                    'maxlength'   => 50,
                                                    'placeholder' => '検索文字①',
                                            ])
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4 no-padding">
                                        <?= 
                                            $this->Form->input('keyword2', [
                                                    'label'       => false,
                                                    'class'       => 'form-control',
                                                    'maxlength'   => 50,
                                                    'placeholder' => '検索文字②',
                                            ])
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4">
                                        <?= 
                                            $this->Form->button('<span class="padding-right-10">
                                                <i class="fa fa-search"></i></span>検索する', 
                                                ['type' => 'submit', 'class' => 'btn btn-default form-control']
                                            )
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div><!-- /.row -->
                    
                    <div class="box-body">
                        <table class="table table-bordered table-hover table-headerfixed">
                            <thead class="bg-navy">
                                <tr>
                                    <th class="center width-5">※</th>
                                    <th class="ellipsis center width-10">日付</th>
                                    <th class="ellipsis center width-10">時刻</th>
                                    <th class="ellipsis width-20">書き込みメンバー</th>
                                    <th class="ellipsis width-55">メッセージタイトル</th>
                                </tr>
                            </thead>
                            <tbody id="click-highlight" class="table-thread" style="height: 310px; font-size:16px;">
                                <?= $this->Form->hidden('login_user_id', ['id' => 'login_user_id', 'value' => $login['id']]) ?>
                                <?php foreach ($threads as $thread): ?>
                                <tr class="cursor-pointer <?= isset($thread->time_exceeded)  ? 'time-exceeded' : '' ?>">
                                    <?= $this->Form->hidden('', ['value' => h($thread->id), 'class' => 'thread_id']) ?>
                                    <?= $this->Form->hidden('', ['value' => h($thread->author_id), 'class' => 'author_id']) ?>
                                    <td style="display: none;">
                                        <input type="radio" name="radio" value="<?= h($thread->id) ?>" >
                                    </td>
                                    <td class="center width-5">
                                    <?= $thread->comment_flag === 1 ? '+' : '' ?>
                                    </td>
                                    <td class="ellipsis center width-10"><?= h($thread->modified->format('m月d日')) ?></td>
                                    <td class="ellipsis center width-10"><?= h($thread->modified->format('H : i')) ?></td>
                                    <td class="ellipsis width-20"><?= h($thread->user->username) ?></td>
                                    <td class="ellipsis width-55"><?= h($thread->title) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= 
                            $this->Form->input('body', [
                                    'id'     => 'text-area',
                                    'label'  => false, 
                                    'type'   => 'textarea', 
                                    'class'  => 'form-control margin-top-10',
                                    'rows'   => '15',
                                    'escape' => false,
                                    'style'  => 'font-size: 16px;'
                            ])
                        ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-lg-12 -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
