<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Request;
use Cake\Controller\Exception\MissingActionException;

class FunctionComponent extends Component
{
    /**
     * URL手入力がある場合、例外処理
     * 
     * @param void
     * @return throw missing_action.ctp
     */
    public function referer()
    {
        $refeler = $this->request->env('HTTP_REFERER');
        if (!isset($refeler) || $refeler === null) {
            throw new MissingActionException(__('不正な操作です'));
        }
    }
    
}
