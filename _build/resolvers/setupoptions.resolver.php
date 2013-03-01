<?php
/**
 * @var array $options;
 */

if (isset($object) && isset($object->xpdo)) {
    $modx = $object->xpdo;
}
if (!isset($modx)) {
    require_once dirname(dirname(dirname(__FILE__))) . '/config.core.php';
    require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
    $modx= new modX();
    $modx->initialize('web');
    $modx->setLogLevel(modX::LOG_LEVEL_INFO);
    $modx->setLogTarget('ECHO');
}

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_UPGRADE:
    //case xPDOTransport::ACTION_INSTALL:
        $domain = $modx->getOption('phpconsole_domain', $options);
        $projectKey = $modx->getOption('phpconsole_project_key', $options);
        $username = $modx->getOption('phpconsole_user_username', $options);
        $apiKey = $modx->getOption('phpconsole_user_api_key', $options);

        if (!empty($domain)) {
            /** @var modSystemSetting $domainSetting */
            $domainSetting = $modx->getObject('modSystemSetting', array('key' => 'phpconsole.domain'));
            if ($domainSetting) {
                $domainSetting->set('value', $domain);
                $domainSetting->save();
            }
        }
        if (!empty($projectKey)) {
            /** @var modSystemSetting $projectKeySetting */
            $projectKeySetting = $modx->getObject('modSystemSetting', array('key' => 'phpconsole.project_key'));
            if ($projectKeySetting) {
                $projectKeySetting->set('value', $projectKey);
                $projectKeySetting->save();
            }
        }
        if (!empty($username) && !empty($apiKey)) {
            /** @var modSystemSetting $usersSetting */
            $usersSetting = $modx->getObject('modSystemSetting', array('key' => 'phpconsole.users'));
            if ($usersSetting) {
                $users = $modx->fromJSON($usersSetting->get('value'));
                if (!$users) $users = array();

                $users[] = array(
                    'username' => $username,
                    'api_key' => $apiKey
                );

                $users = $modx->toJSON($users);
                $usersSetting->set('value', $users);
                $usersSetting->save();
            }
        }
    break;
}
    
    
return true;
