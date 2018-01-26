<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-danger alert-dismissable" onclick="this.classList.add('hidden')">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-warning"></i><b><?= $message ?></b>
</div>
