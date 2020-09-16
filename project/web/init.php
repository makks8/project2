<?php
spl_autoload_register(function ($classNamespace) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $classNamespace);
    $className = $className . '.php';
    $rootPath = getcwd() . "\.." . DIRECTORY_SEPARATOR;

    $path = $rootPath . $className;
    if (file_exists($path)) {
        require_once($path);
    }
});

function searchFile($fileName)
{
    $iterator = new RecursiveDirectoryIterator(getcwd() . '\..', FilesystemIterator::SKIP_DOTS);
    foreach (new RecursiveIteratorIterator($iterator) as $file) {
        if ($file->isDir()) {
            continue;
        }
        if ($file->isFile()) {
            if ($file->getFilename() == $fileName) {
                $file->getPathname();
            }
        }
    }
}
