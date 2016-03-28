<?php
namespace TailoredTunes\UserSession;

use TailoredTunes\UserSession\Dao\SessionDao;

class UserSession
{
    protected $maxTime;
    /**
     * @var SessionDao
     */
    private $dao;

    public function __construct(SessionDao $dao, $sessionName = '')
    {
        $this->dao = $dao;
        $this->maxTime = get_cfg_var("session.gc_maxlifetime");
        if (!empty($sessionName)) {
            session_name($sessionName);
        }
        session_set_save_handler(
            [$this, 'open'],
            [$this, 'close'],
            [$this, 'read'],
            [$this, 'write'],
            [$this, 'destroy'],
            [$this, 'gc']
        );
        session_start();
    }

    public function open($save_path, $session_name)
    {
        return $this->dao->open($save_path, $session_name);
    }

    public function close()
    {
        return $this->dao->close();
    }

    public function read($id)
    {
        return $this->dao->read($id);
    }

    public function write($id, $data)
    {
        return $this->dao->write($id, $data);
    }

    public function destroy($id)
    {
        return $this->dao->destroy($id);
    }

    public function gc($maxTime)
    {
        $this->dao->gc($maxTime);
    }
}
