<?php $this->assign('title', 'メンバー編集'); ?>

<aside class="right-side">

    <section class="content-header">
        <h1>
            メンバー編集
            <small>掲示板利用メンバーを編集します。</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <?= $this->Html->link('トップメニュー', '/') ?>
            </li>
            <li>
            <?php
                if (isset($user_search_uri)) {
                    echo $this->Html->link('メンバー一覧', $user_search_uri);
                } else {
                    echo $this->Html->link('メンバー一覧', ['action' => 'index']);
                }
            ?>
            </li>
            <li>
                編集</li>
            </li>
        </ol>
    </section>

    <section class="content container">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-default">

                    <div class="box-header">
                        <i class="fa fa-pencil"></i>
                        <h3 class="box-title">
                            メンバー編集
                        </h3>
                    </div>
                    
                    <div class="box-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($user) ?>
                    <?= $this->Form->hidden('id') ?>
                        <p class="bottom-20">
                            
                        </p>
                        <div class="form-group">
                        <?=
                            $this->Form->input('name', [
                                    'label'       => 'メンバー名 <span class="label label-warning">必須</span>',
                                    'class'       => 'form-control',
                                    'maxlength'   => 100,
                                    'placeholder' => '全角かな入力',
                                    'style'       => 'font-size: 16px;',
                                    'escape'      => false
                            ])
                        ?>    
                        </div>
                        <div class="form-group">
                        <?=
                            $this->Form->input('username', [
                                    'label'       => 'メンバー表示名 <span class="label label-warning">必須</span>',
                                    'class'       => 'form-control',
                                    'maxlength'   => 100,
                                    'placeholder' => '例) 苗字(所属部署名)',
                                    'style'       => 'font-size: 16px;',
                                    'escape'      => false
                            ])
                        ?>
                        </div>
                        <div class="form-group">
                        <?=
                            $this->Form->input('mail', [
                                    'label'       => 'メールアドレス <span class="label label-warning">必須</span>',
                                    'class'       => 'form-control',
                                    'maxlength'   => 150,
                                    'placeholder' => '例) mail@sky-japan.co.jp',
                                    'style'       => 'font-size: 16px;',
                                    'escape'      => false
                            ])
                        ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                <?=
                                    $this->Form->input('new_password', [
                                            'type'        => 'password',
                                            'label'       => 'パスワード',
                                            'maxlength'   => 15,
                                            'class'       => 'form-control',
                                            'placeholder' => '新しいパスワードを入力',
                                            'style'       => 'font-size: 16px;',
                                    ])
                                ?>
                                </div>
                                <div class="form-group">
                                <?=
                                    $this->Form->input('confirm_new_password', [
                                        'type'        => 'password',
                                        'label'       => 'パスワード確認',
                                        'maxlength'   => 15,
                                        'class'       => 'form-control',
                                        'placeholder' => 'パスワードを再度入力',
                                        'style'       => 'font-size: 16px;',
                                    ])
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer center">
                        <?php
                            echo $this->Html->link('<i class="fa fa-arrow-circle-left"></i>
                                <span class="padding-left-5">戻る</span>', '',
                                [
                                    'escape'  => false,
                                    'class'   => 'btn btn-warning btn-width-80 margin-5',
                                    'onclick' => 'history.back()',
                                ]
                            );
                            echo $this->Form->button('<i class="fa fa-plus"></i>
                                <span class="padding-left-5">更新</span>', 
                                ['type' => 'submit', 'class' => 'btn btn-success btn-width-80 margin-5']
                            );
                            echo $this->Form->end();
                            echo $this->Form->postLink('<i class="fa fa-trash-o"></i>
                                <span class="padding-left-5">削除</span>',
                                ['action' => 'delete', $user->id],
                                [
                                    'escape'  => false,
                                    'class'   => 'btn btn-danger btn-width-80',
                                    'confirm' => '本当に削除しますか?',
                                ]
                            );
                        ?>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </section>
</aside>
