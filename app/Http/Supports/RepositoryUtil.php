<?php

namespace App\Http\Supports;

trait RepositoryUtil
{
	/**  */
	protected $_repos = [];
    protected $_repository = null;

    public function setRepository($repository)
    {
        $this->_repository = $repository;
    }

    public function getRepository()
    {
        return $this->_repository;
    }

	public function registerRepository(...$repo)
	{
		foreach ($repo as $value) {
			$this->_repos[ get_class($value) ] = $value;
		}
		return $this;
	}

	public function fetchRepository($key)
	{
        if ($key) {
            return array_get($this->_repos, $key);
		}
		return null;
	}

	public function fetchModel($className)
	{
		return $this->fetchRepository($className)->getModel();
	}
}
