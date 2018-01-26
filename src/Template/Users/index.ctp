<?php $this->assign('title', 'メンバー一覧'); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
            メンバーリスト
            <small>掲示板システムを利用できるメンバー一覧です。</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <?= $this->Html->link('トップメニュー', '/') ?>
            </li>
            <li>メンバーリスト</li>
       </ol>
   </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-10">
                <div class="box box-solid">

                    <div class="box-header">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">メンバーリスト</h3>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group bottom-10">
                                <?=
                                    $this->Html->link('<i class="fa fa-plus-square"></i>
                                        <span class="padding-left-5">メンバー新規追加</span>', 
                                        ['action' => 'add'],
                                        ['escape' => false, 'class' => 'btn bg-navy']
                                    )
                                ?>
                                </div>
                            </div>
                            <?= $this->Form->create('', ['type' => 'get']) ?>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <?=
                                        $this->Form->input('key',
                                            [
                                                'div'         => false,
                                                'label'       => false,
                                                'class'       => 'form-control',
                                                'maxlength'   => 50,
                                                'placeholder' => '検索文字を入力してください。',
                                            ]
                                        )
                                    ?>
                                    <span class="input-group-btn">
                                    <?=
                                        $this->Form->button('<span class="padding-right-10">
                                            <i class="fa fa-search"></i></span>検索する',
                                            ['type' => 'submit', 'class' => 'btn btn-default']
                                        )
                                    ?>
                                    </span>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        
                        <hr>
                        
                        <?= $this->Flash->render() ?>

                        <div class="box-tools">
                            <p class="pull-right">
                            <?= $this->Paginator->counter(['format' => __('登録人数 : {{count}} 人, &nbsp;&nbsp;ページ数: {{page}}/{{pages}}')]) ?>
                            </p>
                            <ul class="pagination pagination-large no-margin">
                                <?= $this->Paginator->prev(__('前へ')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('次へ')) ?>
                            </ul>
                        </div>

                        <table class="table table-bordered table-hover table-striped table-user">
                            <thead class="table-header">
                                <tr>
                                    <th class="ellipsis center">メンバー名</th>
                                    <th class="ellipsis center" >メンバー表示名</th>
                                    <th class="ellipsis center" style="width:25%;"><?= $this->Paginator->sort('mail', 'メールアドレス') ?></th>
                                    <th class="ellipsis center" style="width:15%;"><?= $this->Paginator->sort('created', '作成日') ?></th>
                                    <th class="ellipsis center" style="width:15%;"><?= $this->Paginator->sort('modified', '更新日') ?></th>
                                </tr>
                            </thead>
                            <tbody id="click-highlight">
                            <?php foreach ($users as $user): ?>
                                <tr data-href="<?= $this->url->build('/users/edit/', true) . h($user->id) ?>" style="font-size: 16px; cursor: pointer;">
                                    <td class="ellipsis center"><?= h($user->name) ?></td>
                                    <td class="ellipsis center"><?= h(tw($user->username, 40)) ?></td>
                                    <td class="ellipsis center"><?= h($user->mail) ?></td>
                                    <td class="ellipsis center"><?= h($user->created) ?></td>
                                    <td class="ellipsis center"><?= h($user->modified) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer center">
                    <?=
                        $this->Html->link('<i class="fa fa-arrow-circle-left"></i>
                        <span class="padding-left-5">トップメニュー</span>', '/',
                            ['escape' => false, 'class' => 'btn btn-warning btn-width-150']
                        )
                    ?>
                    </div>
                </div><!-- /.box-primary -->
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </section>
</aside>
