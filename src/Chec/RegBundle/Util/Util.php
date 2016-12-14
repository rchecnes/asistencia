<?php
namespace Chec\RegBundle\Util;

class Util
{
	public function __construct()
    {
        $this->em   = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager();
        $this->conn = $GLOBALS['kernel']->getContainer()->get('database_connection');
    }

    public function saludo($message)
    {
        return $message;
    }
}
