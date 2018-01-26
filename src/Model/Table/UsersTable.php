<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Threads', [
            'foreignKey' => 'author_id',
            'dependent'  => true,
        ]);
        
        $this->hasMany('Comments', [
            'foreignKey' => 'author_id',
            'dependent'  => true,
        ]);
    }

    /**
     * バリデート
     *
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->provider('custom', 'App\Model\Validation\CustomValidation');
        
        $validator
            ->allowEmpty('id');

        $validator
            ->requirePresence('name')
            ->notEmpty('name')
            ->add('name', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);

        $validator
            ->requirePresence('username')
            ->notEmpty('username')
            ->add('username', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);
            

        $validator
            ->requirePresence('mail')
            ->notEmpty('mail')
            ->add('mail', 'validFormat', [
                'rule'    => 'email',
                'message' => 'メール形式で入力してください。'
            ]);
            
        $validator
            ->notEmpty('password')
            ->lengthBetween('password', [4, 15], 'パスワードは半角英数字4～15文字以内で入力してください。')
            ->alphaNumeric('password', '半角英数字で入力してください。')
            ->add('password', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);
        
        $validator
            ->notEmpty('confirm_password')
            ->add('confirm_password', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);
        
        $validator->add('confirm_password', 'no-misspelling', [
            'rule'    => ['compareWith', 'password'],
            'message' => 'パスワードが一致しません',
        ]);
        
        $validator
            ->allowEmpty('new_password')
            ->lengthBetween('new_password', [4, 15], 'パスワードは半角英数字4～15文字以内で入力してください。')
            ->alphaNumeric('new_password', '半角英数字で入力してください。')
            ->add('new_password', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);
        
        $validator
            ->allowEmpty('confirm_new_password')
            ->add('confirm_new_password', 'custom', [
                'rule'     => 'isSpace',
                'provider' => 'custom',
                'message'  => '空白文字は受け付けません。'
            ]);
        
        $validator->add('confirm_new_password', 'no-misspelling', [
            'rule'    => ['compareWith', 'new_password'],
            'message' => 'パスワードが一致しません',
        ]);
        
        return $validator;
    }

    /**
     * ビルドルール(save時にチェック)
     *
     * @param \Cake\ORM\RulesChecker $rules
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['mail']), ['message' => '登録済みのメールアドレスです']);
        return $rules;
    }
    
    
    /**
    * ユーザデータ条件検索 -  name, username, mail いずれか該当すれば
    *
    * @param string $requests
    * @return Object Query
    */
    public function findByNameOrUsernameOrEmail($requests)
    {
        return $this->find('all')
            ->where(['OR' => [
                ['Users.name LIKE'     => '%' . $requests . '%'], 
                ['Users.username LIKE' => '%' . $requests . '%'], 
                ['Users.mail LIKE'     => '%' . $requests . '%'], 
            ]]);
    }
}
