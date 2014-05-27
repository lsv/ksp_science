<?php
namespace Ksp\ScienceBundle\FileParser;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Parser
{

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private $file;
    
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }
    
    public function validatePersistentFile()
    {
        if (! $this->file->getClientOriginalExtension() === 'sfs') {
            throw new \Exception('Wrong file extension');
        }
        
        if (! $this->file->getClientOriginalName() === 'persistent.sfs') {
            throw new \Exception('Wrong file name');
        }
        
        $data = file_get_contents($this->file->getRealPath());
        if (strpos($data, 'GAME') !== 0) {
            throw new \Exception('Wrong data');
        }
        
        file_put_contents(__DIR__ . '/../../../../app/uploads/' . time() . '_' . rand(0,1000) . '.persistent.sts', $data);
        return true;
        
    }

    public function parsePersistentFile()
    {
        $xml = $this->parseFile('persistent');
        if ($xml === false) {
            return array();
        }
        
        /*
        header('Content-Type: text/xml');
        echo $xml->asXML();
        exit;
        */
        
        $output = array();        
        foreach($xml->GAME->SCENARIO as $scenario) {
            if ($this->__($scenario->name) !== 'ResearchAndDevelopment') {
                continue;
            }
            
            foreach($scenario->Science as $science) {
                $output[$this->__($science->id)] = array(
                    'cap' => $this->__($science->cap),
                    'points' => $this->__($science->sci)
                );
            }
        }
        
        return $output;
        
    }

    /**
     * @param $root
     * @return \SimpleXMLElement|false
     */
    private function parseFile($root)
    {
        $xml = new \XMLWriter;
        $xml->openMemory();

        $xml->startDocument();
        $xml->startElement($root);

        $content = file_get_contents($this->file->getRealPath());

        $lastLine = '';
        $lines = explode("\n", $content);
        foreach($lines as $line) {
            $line = trim($line);
            if ($line == '') continue;
            if (strpos($line, '//') === 0) continue;


            if (strpos($line, '=') !== false) {
                list($key,$value) = explode('=', $line);
                if (! preg_match('/[a-zA-Z]/', $key)) {
                    continue;
                }

                $xml->startElement(trim($key));
                $xml->writeCdata(trim($value));
                $xml->endElement();
            }

            if ($line === '{') {
                $xml->startElement($lastLine);
            }

            if ($line === '}') {
                $xml->endElement();
            }

            $lastLine = $line;
        }

        $xml->endElement();

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xml->outputMemory(true));
        if (libxml_get_errors()) {
            return false;
        }

        return $xml;

    }
    
    private function __(\SimpleXMLElement $element)
    {
        return (string)$element;
    }

} 