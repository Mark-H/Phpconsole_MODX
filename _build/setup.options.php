<?php

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $domain = $modx->getOption('phpconsole.domain');
        $projectKey = $modx->getOption('phpconsole.project_key');

        $users = $modx->getOption('phpconsole.users');
        $users = $modx->fromJSON($users);

        $output = <<<HTML
<p>To get started, <a href="http://phpconsole.com/">create an account</a> and fill in the details below to configure the MODX Service Wrapper for phpconsole.</p>
<br />
<p>You can customize all of this later through System > System Settings > phpconsole.</p>

<label>Domain <br />
    <input type="text" name="phpconsole_domain" value="$domain">
</label>
<label>Project API Key <br />
    <input type="text" name="phpconsole_project_key" value="$projectKey">
</label>
HTML;
        if (empty($users)) {
            $output .= <<<HTML
    <fieldset>
    <legend>User</legend>
    <label>Username <br />
        <input type="text" name="phpconsole_user_username">
    </label>
    <label>API Key <br />
        <input type="text" name="phpconsole_user_api_key">
    </label>
    </fieldset>
HTML;
        }
        break;
    default:
    case xPDOTransport::ACTION_UNINSTALL:
        $output = '';
        break;
}

return $output;
