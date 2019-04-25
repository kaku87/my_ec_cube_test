<?php

namespace Plugin\LineLoginIntegration\Entity;

use Eccube\Entity\AbstractEntity;

class LineLoginIntegrationSetting extends AbstractEntity
{

    private $id;
    private $line_channel_id;
    private $line_channel_secret;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getLineChannelId()
    {
        return $this->line_channel_id;
    }

    public function setLineChannelId($line_channel_id)
    {
        $this->line_channel_id = $line_channel_id;
        return $this;
    }

    public function getLineChannelSecret()
    {
        return $this->line_channel_secret;
    }

    public function setLineChannelSecret($line_channel_secret)
    {
        $this->line_channel_secret = $line_channel_secret;
        return $this;
    }
}
