<?php
/**
 * Created by PhpStorm.
 * User: raph
 * Date: 20/12/16
 * Time: 03:53
 */

namespace Efrogg\TrafficCatcher;


use Efrogg\TrafficCatcher\Data\Data;
use Efrogg\TrafficCatcher\DataPersister\DataPersisterInterface;
use Efrogg\TrafficCatcher\Modifier\Modifier;
use Efrogg\TrafficCatcher\SessionHandler\SessionHandlerInterface;
use Efrogg\TrafficCatcher\SessionHandler\SimpleSessionHandler;
use Efrogg\TrafficCatcher\Trigger\TriggerInterface;

class TrafficCatcher
{

    /** @var  TriggerInterface[] */
    protected $triggers = array();

    /** @var  SessionHandlerInterface */
    protected $session_handler;

    /** @var  DataPersisterInterface */
    protected $data_persister;

    /** @var  Data */
    protected $data;

    /** @var  Modifier[] */
    protected $modifiers;

    /**
     * @param TriggerInterface $trigger
     * @return $this
     */
    public function addTrigger(TriggerInterface $trigger)
    {
        $this->triggers[] = $trigger;
        return $this;
    }

    /**
     * @param SessionHandlerInterface $handler
     * @return $this
     */
    public function setSessionHandler(SessionHandlerInterface $handler)
    {
        $this->session_handler = $handler;
        return $this;
    }

    /**
     * @param DataPersisterInterface $dataPersister
     * @return $this
     */
    public function setDataPersister(DataPersisterInterface $dataPersister)
    {
        $this->data_persister = $dataPersister;
        return $this;
    }

    public function initialize()
    {
        foreach ($this->triggers as $trigger) {
            if ($trigger->accept()) {
                if (null == $this->session_handler) {
                    $this->session_handler = new SimpleSessionHandler();
                }
                $this->session_handler->setSessionName($trigger->getSessionName());
                break;
            } elseif ($trigger->refuse() && null !== $this->session_handler) {
                $this->session_handler->stop();
            }
        }

        if ($this->session_handler && $this->session_handler->getSessionName()) {
            $this->startCatch();
        }
    }

    public function startCatch()
    {
        register_shutdown_function(array($this, "persistTraffic"));
    }

    /**
     * @param Data $data
     * @return TrafficCatcher
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function persistTraffic()
    {
        if (null !== $this->data_persister && null !== $this->data) {

            foreach ($this->modifiers as $modifier) {
                $modifier->modify($this->data);
            }
            $this->data_persister->persist($this->data, $this->session_handler->getSessionName());
        }
    }


    /**
     * @param Modifier $modifier
     */
    public function addModifier(Modifier $modifier)
    {
        $this->modifiers[] = $modifier;
        return $this;
    }
}