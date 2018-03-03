<?php

namespace Huasituo\Hstcms\Repositories;

use Huasituo\Hstcms\Contracts\Repository as RepositoryContract;

use Illuminate\Config\Repository as Config;

class Repository implements RepositoryContract
{
    /**
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Constructor method.
     *
     * @param \Illuminate\Config\Repository     $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function version()
    {
        return $this->config->get('hstcms.version');
    }
}
