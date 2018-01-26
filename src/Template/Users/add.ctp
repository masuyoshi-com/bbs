<?php $this->assign('title', 'メンバー新規追加'); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
            メンバー新規追加
            <small>掲示板システムを利用できる新規メンバーを追加します。</small>
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
                新規追加</li>
            </li>
        </ol>
    </section>

    <section class="content container">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-default">
                    
                    <div class="box-header">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">
                            メンバー新規追加
                        </h3>
                    </div>
                    <div class="box-body">
                        <?= $this->Flash->render() ?>
                        <?= $this->Form->create($user) ?>
                        <p class="bottom-20">
                            <span class="label label-warning">項目は全て必須です。</span>
                        </p>
                        <div class="form-group">
                        <?=
                            $this->Form->input('name', [
                                    'label'       => 'メンバー名',
                                    'class'       => 'form-control',
                                    'maxlength'   => 100,
                                    'placeholder' => '全角かな入力',
                                    'style'       => 'font-size: 16px;',
                            ])
                        ?>
                        </div>
                        <div class="form-group">
                        <?=
                            $this->Form->input('username',[
                                    'label'       => 'メンバー表示名',
                                    'class'       => 'form-control',
                                    'maxlength'   => 100,
                                    'placeholder' => '例) 苗字(所属部署名)',
                                    'style'       => 'font-size: 16px;',
                            ])
                        ?>
                        </div>
                        <div class="form-group">
                        <?=
                            $this->Form->input('mail', [
                                    'label'       => 'メールアドレス',
                                    'class'       => 'form-control',
                                    'maxlength'   => 150,
                                    'placeholder' => '例) mail@sky-japan.co.jp',
                                    'style'       => 'font-size: 16px;',
                            ])
                        ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="form-group">
                                <?=
                                    $this->Form->input('password', [
                                            'label'       => 'パスワード',
                                            'maxlength'   => 15,
                                            'class'       => 'form-control',
                                            'placeholder' => '半角英数字15文字以内',
                                            'style'       => 'font-size: 16px;',
                                    ])
                                ?>
                                </div>
                                <div class="form-group">
                                <?=
                                    $this->Form->input('confirm_password', [
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
                        <div class="callout callout-warning padding-5" style="font-size: 16px;">
                            ※半角英数字4～15文字以内で入力してください。
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
                            echo $this->Form->button('登録 <span class="padding-left-5">
                                <i class="fa fa-arrow-circle-right"></i></span>',
                                ['type'  => 'submit', 'class' => 'btn btn-success btn-width-80 margin-5']
                            );
                        ?>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
            <?= $this->Form->end() ?>
        </div><!-- /.row -->
    </section>
</aside>
