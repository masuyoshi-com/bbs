<?php $this->assign('title', 'コメント書込み'); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
            子スレッド - コメント書込み
            <small>新規コメントを書込みます。</small>
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
                子スレッド書込み</li>
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
                            子スレッド書込み
                        </h3>
                    </div>
                    <div class="box-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($comment) ?>
                    <?= $this->Form->hidden('thread_id', ['value' => h($thread->id)]) ?>
                    <?= $this->Form->hidden('author_id', ['value' => h($login['id'])]) ?>
                        <div class="form-group">
                        <?= $this->Form->input('fixed_phrase', [
                                    'label'   => '定型文',
                                    'type'    => 'select',
                                    'class'   => 'form-control fixed-select',
                                    'empty'   => '選択してください',
                                    'style'   => 'font-size: 18px; height: 50px;',
                                    'options' => [
                                            '了解しました。'       => '了解しました。', 
                                            'よろしくお願いします。' => 'よろしくお願いします。',
                                    ],
                            ])
                        ?>
                        </div>
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
                        <?= $this->Form->input('body', [
                                    'label'       => 'メッセージ',
                                    'type'        => 'textarea',
                                    'class'       => 'form-control',
                                    'placeholder' => '子スレッド内容を入力して下さい。',
                                    'rows'        => '13',
                                    'style'       => 'font-size: 18px;',
                            ])
                        ?>
                        </div>
                        <div class="box-footer center">
                        <?= $this->Html->link('<i class="fa fa-arrow-circle-left"></i>
                                <span class="padding-left-5">戻る</span>',
                                ['action' => 'index', h($thread->id)],
                                ['escape' => false, 'class' => 'btn btn-warning btn-width-80 margin-5']
                            )
                        ?>
                        <?= $this->Form->button('登録 <span class="padding-left-5">
                                <i class="fa fa-arrow-circle-right"></i></span>',
                                ['type' => 'submit', 'class' => 'btn btn-success btn-width-80 margin-5']
                            )
                        ?>
                        </div>
                    <?= $this->Form->end() ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </section>
</aside>
