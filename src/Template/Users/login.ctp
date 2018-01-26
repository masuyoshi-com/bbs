<?= $this->Flash->render() ?>
<?= $this->Form->create('', ['class' => 'form-signin']) ?>
<h2 class="form-signin-heading">
    <?= $this->Html->image('logo.png', ['alt' => 'スカイジャパングループ']) ?>
</h2>
<div class="center margin-20">
    <h5>スカイジャパン掲示板システム</h5>
</div>
<hr>
<?= $this->Form->input('mail', [
        'label'       => 'ユーザー',
        'class'       => 'form-control',
        'placeholder' => 'UserName',
        'autofocus'   => 'autofocus',
        'required'
    ])
?>
<?= $this->Form->input('password', [
        'label'       => 'パスワード',
        'class'       => 'form-control',
        'placeholder' => 'Password',
        'style'       => 'margin-bottom: 20px;',
        'required'
    ])
?>
<?= $this->Form->submit('ログイン', ['class' => 'btn btn-primary btn-block']) ?>
<?= $this->Form->end() ?>
<hr>
<div class="center">
    <p style="color: #555; font-size: 1rem;">© <?= date('Y') ?> SkyJapan Co.,Ltd. All Rights Reserved.</p>
</div>
