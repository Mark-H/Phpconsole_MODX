--------------------------------------------
Phpconsole for MODX v1.0.0-rc1
--------------------------------------------
Author: Mark Hamstra - hello@markhamstra.com
--------------------------------------------

Phpconsole for MODX implements a Service class for phpconsole.com.

By installing the Phpconsole package through Package Management and if needed adjusting the configuration through
system settings, you can use code like the example below throughout MODX and your extensions:

    if (isset($modx->phpconsole)) $modx->phpconsole->send($someData, 'username');

The Phpconsole for MODX service class also lets you log xPDOObject derivatives by simply passing it as the data to
send; it will automatically call the toArray() method.

Have fun!




