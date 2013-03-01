<?php
require_once dirname(__FILE__) . '/phpconsole.class.php';
/**
 * MODX Service Wrapper for phpconsole()
 */

class Phpconsole_MODX extends Phpconsole {
    /** @var modX $modx */
    public $modx;
    /**
     * Constructor - sets preferences
     */
    public function __construct(modX &$modx) {
        parent::__construct();
        $this->modx = $modx;

        $this->set_backtrace_depth($this->modx->getOption('phpconsole.backtrace_depth', null, 1));
        $this->set_domain($this->modx->getOption('phpconsole.domain', null, '.localhost'));

        $users = $this->modx->getOption('phpconsole.users');
        $users = $this->modx->fromJSON($users);
        if (is_array($users)) {
            $projectApiKey = $this->modx->getOption('phpconsole.project_key', null);
            foreach ($users as $user) {
                $nickname = $this->modx->getOption('username', $user);
                $userApiKey = $this->modx->getOption('api_key', $user);

                $this->add_user($nickname, $userApiKey, $projectApiKey);
            }
        }
    }
}
