<?php

namespace Plugin\LineLoginIntegration\Repository;

use Doctrine\ORM\EntityRepository;
use Eccube\Common\Constant;
use Plugin\LineLoginIntegration\Entity\LineLoginIntegration;

class LineLoginIntegrationRepository extends EntityRepository
{

    public $app;

    public function setApplication($app)
    {
        $this->app = $app;
    }

}
