<?php

namespace Base;

class NamespaceAutoloader
{
    protected $namespaceMap = [];

    public function addNamespace($namespace, $rootDir)
    {
        if ( is_dir($rootDir) ) {
            $this->namespaceMap[$namespace] = $rootDir;
            return true;
        }

        return false;
    }

    public function register()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    protected function autoload($class)
    {
        $pathParts = explode('\\', $class);

        if ( is_array($pathParts) ) {
            $namespace = array_shift($pathParts);
            if ( !empty($this->namespaceMap[$namespace]) ) {
                $filePath = $this->namespaceMap[$namespace].'/'.implode('/', $pathParts).'.php';
                if ( file_exists($filePath) ) {
                    require_once $filePath;
                    return true;
                }
                else
                    throw new \Exception("Error 404. Sorry. This page doees not exist.");
            }
        }

        return false;
    }
}