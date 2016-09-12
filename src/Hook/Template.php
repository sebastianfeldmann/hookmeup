<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace sebastianfeldmann\CaptainHook\Hook;

/**
 * Template class
 *
 * @package CaptainHook
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/captainhook
 * @since   Class available since Release 0.9.0
 */
abstract class Template
{
    /**
     * Return the php code for the git hook scripts.
     *
     * @param  string $hook
     * @return string
     */
    public static function getCode($hook)
    {
        return '#!/usr/bin/env php' . PHP_EOL .
               '<?php' . PHP_EOL .
               '$autoLoader = __DIR__ . \'/../../vendor/autoload.php\';' . PHP_EOL . PHP_EOL .
               'if (!file_exists($autoLoader)) {' . PHP_EOL .
               '    fwrite(STDERR,' . PHP_EOL .
               '        \'Composer autoload.php could not be found\' . PHP_EOL .' . PHP_EOL .
               '        \'Please re-install the hook with:\' . PHP_EOL .' . PHP_EOL .
               '        \'$ captainhook install --composer-vendor-path=...\' . PHP_EOL' . PHP_EOL .
               '    );' . PHP_EOL .
               '    exit(1);' . PHP_EOL .
               '}' . PHP_EOL .
               'require $autoLoader;' . PHP_EOL .
               '$config = realpath(__DIR__ . \'/../../captainhook.json\');' . PHP_EOL .
               '$app    = new sebastianfeldmann\CaptainHook\Console\Application\Hook();' . PHP_EOL .
               '$app->setHook(\'' . $hook . '\');' . PHP_EOL .
               '$app->setConfigFile($config);' . PHP_EOL .
               '$app->run();' . PHP_EOL . PHP_EOL;
    }
}