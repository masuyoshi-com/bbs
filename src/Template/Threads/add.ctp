<?php $this->assign('title', 'スレッド書込み'); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
            親スレッド書込み
            <small>新規にスレッドを立てます。</small>
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
                スレッド書込み</li>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-10">
                <div class="box box-primary">

                    <div class="box-header">
                        <i class="fa fa-pencil-square"></i>
                        <h3 class="box-title">
                            親スレッド新規追加
                        </h3>
                    </div>
                    <div class="box-body">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create($thread) ?>
                    <?= $this->Form->input('author_id', ['type' => 'hidden', 'value' => h($login['id'])]) ?>
                        <div class="form-group">
                        <?= 
                            $this->Form->input('title', [
                                    'label'       => 'メッセージタイトル <span class="label label-warning">必須</span>',
                                    'class'       => 'form-control',
                                    'maxlength'   => '255',
                                    'placeholder' => 'スレッドのタイトルを入力して下さい。',
                                    'style'       => 'font-size: 18px; height:50px;',
                                    'escape'      => false
                            ])
                        ?>
                        </div>
                        <div class="form-group">
                        <?= 
                            $this->Form->input('body', [
                                    'label'       => 'メッセージ <span class="label label-warning">必須</span>',
                                    'type'        => 'textarea',
                                    'class'       => 'form-control',
                                    'placeholder' => 'スレッド内容を入力して下さい。',
                                    'rows'        => '19',
                                    'style'       => 'font-size: 18px;',
                                    'escape'      => false
                            ])
                        ?>
                        </div>
                        <div class="box-footer center">
                        <?= $this->Html->link('<i class="fa fa-arrow-circle-left"></i>
                                <span class="padding-left-5">戻る</span>', '', [
                                    'escape'  => false,
                                    'class'   => 'btn btn-warning btn-width-80 margin-5',
                                    'onclick' => 'history.back()'
                            ])
                        ?>
                        <?= $this->Form->button('登録 <span class="padding-left-5">
                                <i class="fa fa-arrow-circle-right"></i></span>', [
                                    'type'  => 'submit',
                                    'class' => 'btn btn-success btn-width-80 margin-5',
                            ])
                        ?>
                        </div>
                    <?= $this->Form->end() ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </section>
</aside>
