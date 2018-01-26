<?php $this->assign('title', 'コメント編集'); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
            子スレッド - コメント編集
            <small>登録済みのコメントを編集できます。</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <?php
                    if (isset($thread_search_uri)) {
                        echo $this->Html->link('スレッド一覧', $thread_search_uri);
                    } else {
                        echo $this->Html->link('スレッド一覧', '/');
                    }
                ?>
            </li>
            <li>
                <?= $this->Html->link('子スレッド一覧', ['action' => 'index', h($thread->id)]) ?>
            </li>
            <li>
                子スレッド編集</li>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-10">
                <div class="box box-primary">

                    <div class="box-header">
                        <i class="fa fa-comment"></i>
                        <h3 class="box-title">
                            子スレッド編集
                        </h3>
                    </div>
                    <div class="box-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($comment) ?>
                    <?= $this->Form->hidden('id') ?>
                    <?= $this->Form->hidden('comment_flag', ['value' => 1]) ?>
                    <?= $this->Form->hidden('thread_id',    ['value' => h($thread->id)]) ?>
                    <?= $this->Form->hidden('author_id',    ['value' => h($login['id'])]) ?>
                        <div class="form-group">
                        <?=  $this->Form->input('title', [
                                    'label'       => 'メッセージタイトル <span class="label label-warning">必須</span>',
                                    'class'       => 'form-control select-results',
                                    'maxlength'   => '255',
                                    'placeholder' => '子スレッドのタイトルを入力して下さい。',
                                    'style'       => 'font-size: 18px; height: 50px;',
                                    'escape'      => false
                            ])
                        ?>
                        </div>
                        <div class="form-group">
                        <?=  $this->Form->input('body', [
                                    'label'       => 'メッセージ',
                                    'type'        => 'textarea',
                                    'class'       => 'form-control',
                                    'placeholder' => '子スレッド内容を入力して下さい。',
                                    'rows'        => '16',
                                    'style'       => 'font-size: 18px;',
                            ])
                        ?>
                        </div>
                        <div class="box-footer center">
                        <?= $this->Html->link('<i class="fa fa-arrow-circle-left"></i>
                                <span class="padding-left-5">戻る</span>',
                                    ['action' => 'index', $thread->id],
                                    ['escape' => false, 'class' => 'btn btn-warning btn-width-80 margin-5']
                            )
                        ?>
                        <?= $this->Form->button('更新 <span class="padding-left-5">
                            <i class="fa fa-arrow-circle-right"></i></span>',
                                ['type' => 'submit', 'class' => 'btn btn-success btn-width-80 margin-5']
                            )
                        ?>
                        <?= $this->Form->end() ?>
                        <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>
                                <span class="padding-left-5">削除</span>',
                                ['action' => 'delete', $comment->id, $thread->id],
                                [
                                    'escape'  => false,
                                    'class'   => 'btn btn-danger margin-5',
                                    'confirm' => '本当に削除しますか?',
                                ]
                            )
                        ?>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </section>
</aside>
