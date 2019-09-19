<?php

namespace Akeneo\Bundle\BatchBundle\Monolog\Handler;

/**
 * Write the log into a separate log file
 *
 * @author    Gildas Quemener <gildas.quemener@gmail.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/MIT MIT
 */
class NullableLogHandler extends BatchLogHandler
{
    /** @var string */
    protected $filename;

    /** @var string */
    protected $logDir;

    protected $isEnabledLog;

    /**
     * @param string          $logDir         Batch log directory
     * @param Boolean         $isEnabledLog   Defined if we do use logs of BatchLogHandler
     */
    public function __construct(
        $logDir,
        $isEnabledLog = true
    ) {
        $this->isEnabledLog = $isEnabledLog;
        if($this->isEnabledLog) {
            parent::__construct($logDir);
        }
    }

    /**
     * Get the filename of the log file if $isEnabledLog is true
     *
     * @return string
     */
    public function getFilename()
    {
        if($this->isEnabledLog){
            return parent::getFilename();
        }else{
            return '' ;
        }
    }

    /**
     * @param string $subDirectory
     */
    public function setSubDirectory($subDirectory)
    {
        if($this->isEnabledLog){
            $this->url = parent::setSubDirectory($subDirectory);
        }else{
            $this->url = '' ;
        }
    }

    /**
     * Get the real path of the log file
     *
     * @param string $filename
     * @param string $subDirectory
     *
     * @return string
     *
     * @deprecated
     */
    public function getRealPath($filename, $subDirectory = null)
    {
        if ($this->isEnabledLog) {
            return parent::getRealPath($filename, $subDirectory);
        }
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function write(array $record)
    {
        if($this->isEnabledLog){
            parent::write($record);
        }

    }

    /**
     * Generates a random filename
     *
     * @return string
     */
    private function generateLogFilename()
    {
        if($this->isEnabledLog){
            return sprintf('batch_%s.log', sha1(uniqid(rand(), true)));
        }

    }
}
