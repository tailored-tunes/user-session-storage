<?php
namespace TailoredTunes\UserSession\Dao;

interface SessionDao
{
    public function open();

    public function close();

    public function read($id);

    public function write($id, $data);

    public function destroy($id);

    public function gc();
}
