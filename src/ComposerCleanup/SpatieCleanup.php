<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\ComposerCleanup;

use Exception;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Flushable;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\ORM\DB;

class SpatieCleanup implements Flushable
{
    use Configurable;
    use Injectable;

    private const DEBUG = false;

    private static $folders_to_delete = [
        'vendor/spatie/schema-org/generator',
        'vendor/spatie/schema-org/src',
    ];

    private static $keep_folders = [
        'vendor/spatie/schema-org/src/Exceptions',
    ];

    private static $keep_files = [
        'vendor/spatie/schema-org/src/Type.php',
        'vendor/spatie/schema-org/src/BaseType.php',
        'vendor/spatie/schema-org/src/ListItem.php',
        'vendor/spatie/schema-org/src/BreadcrumbList.php',
        'vendor/spatie/schema-org/src/WebPage.php',
        'vendor/spatie/schema-org/src/Contracts/CreativeWorkContract.php',
        'vendor/spatie/schema-org/src/Contracts/ThingContract.php',
        'vendor/spatie/schema-org/src/Type.php',
    ];

    public static function flush()
    {
        $config = self::config();
        $foldersToDelete = self::get_real_paths($config->get('folders_to_delete'));
        $keepFolders = self::get_real_paths($config->get('keep_folders'));
        $keepFiles = $config->get('keep_files');
        // add contracts
        $keepFiles = self::add_contracts($keepFiles);
        $keepFiles = self::get_real_paths($keepFiles);

        foreach ($foldersToDelete as $folder) {
            self::delete_files($folder, $keepFolders, $keepFiles);
            self::delete_empty_dirs($folder);
        }
        exec('composer dump-autoload');
    }

    private static function delete_files(string $directory, array $keepFolders, array $keepFiles): void
    {
        $directoryIterator = new RecursiveDirectoryIterator($directory);
        $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($iterator as $file) {

            // Skip directories that are in the keep list
            if (in_array(dirname($file->getRealPath()), $keepFolders, true)) {
                if(self::DEBUG) {
                    DB::alteration_message('Skipping ' . $file->getRealPath(), 'created');
                }
                continue;
            }

            // Delete files that are not in the keep list
            if ($file->isFile() && !in_array($file->getRealPath(), $keepFiles, true)) {
                try {
                    if(self::DEBUG) {
                        DB::alteration_message('DELETING ' . $file->getRealPath(), 'created');
                    }
                    unlink($file->getRealPath());
                } catch (Exception $e) {
                    if(self::DEBUG) {
                        DB::alteration_message('Failed to delete ' . $file->getRealPath() . ': ' . $e->getMessage(), 'deleted');
                    }
                }
            } else {
                if(self::DEBUG) {
                    DB::alteration_message('Skipping ' . $file->getRealPath(), 'created');
                }
            }
        }
    }

    private static function delete_empty_dirs(string $directory): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDir()) {
                $folderContents = scandir($fileInfo->getRealPath());
                if ($folderContents !== false && count($folderContents) == 2) { // Only '.' and '..'
                    rmdir($fileInfo->getRealPath());
                }
            }
        }
    }

    private static function get_real_paths(array $array): array
    {
        foreach($array as $key => $value) {
            $array[$key] = realpath(Controller::join_links(Director::baseFolder(), $value));
        }
        return $array;
    }

    private static function add_contracts(array $array): array
    {
        foreach($array as $key => $value) {
            $array[] = preg_replace('/\/src\/(.*?)\.php$/', '/src/Contracts/${1}Contract.php', $value);
        }
        return $array;
    }

}
