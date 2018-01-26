<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Threads
 * @property \Cake\ORM\Association\BelongsTo $Authors
 *
 * @method \App\Model\Entity\Comment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Comment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comment findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('comments');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Threads', [
            'foreignKey' => 'thread_id',
            'joinType'   => 'INNER'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'author_id'
        ]);
    }

    /**
     *バリデート
     *
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->provider('custom', 'App\Model\Validation\CustomValidation');
        
        $validator
            ->allowEmpty('id', 'create');

            $validator
                ->requirePresence('title')
                ->notEmpty('title')
                ->add('title', 'custom', [
                    'rule'     => 'isSpace',
                    'provider' => 'custom',
                    'message'  => '空白文字は受け付けません。'
                ]);

            $validator
                ->allowEmpty('body')
                ->add('body', 'custom', [
                    'rule'     => 'isSpace',
                    'provider' => 'custom',
                    'message'  => '空白文字は受け付けません。'
                ]);
            
        return $validator;
    }

    /**
     * ビルドルール
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['thread_id'], 'Threads'));
        return $rules;
    }
    
    
    /**
    * コメント一覧レコード取得
    *
    * @param string $thread_id 選択されたスレッドID
    * @return object Query
    */
    public function findByThreadId($thread_id = null)
    {
        return  $this->find('all')
            ->where(['thread_id' => $thread_id])
            ->contain(['Users'])
            ->order(['Comments.modified' => 'desc']);
    }
}
