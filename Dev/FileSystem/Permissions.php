<?php
namespace LazarusPhp\FileSystem;

class Permissions
{

    private array $modes = [0600, 0644, 0664, 0700, 0755, 0777];


    public function readable(string $path):bool
    {
        return is_readable($path) ? true : false;
    }

    public function writable(string $path):bool
    {
        return is_writeable($path) ? true : false;
    }

    public function validMode(int $mode):bool
    {
        if (in_array($mode, $this->modes)) {
            return true;
        } else {
            return false;
        }
    }

    // Has Permissions Section goes here
}