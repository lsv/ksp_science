<?php
namespace Ksp\ScienceBundle\FileParser;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ksp\ScienceBundle\Entity;
use Ksp\ScienceBundle\Document;

class Parser
{

    private $errorFile = '/../../../../biomeErrors.log';

    /**
     * @var Entity\Repository\Biome
     */
    private $biomeManager;

    public function __construct(Entity\Repository\Biome $biomeManager)
    {
        $this->biomeManager = $biomeManager;
    }

    private function __(\SimpleXMLElement $element)
    {
        return (string)$element;
    }

    /**
     * @param UploadedFile $file
     * @return array
     */
    public function parseScienceFile(UploadedFile $file)
    {
        $xml = $this->parseFile($file, 'science');
        if ($xml === false) {
            return false;
        }

        $sciences = array();
        foreach($xml->EXPERIMENT_DEFINITION as $experiment) {
            /** @var \SimpleXMLElement $experiments */
            $tech = new Document\Tech;
            $tech
                ->setName($this->__($experiment->title))
                ->setKspkey($this->__($experiment->id))
            ;

            foreach($experiment->RESULTS->children() as $result) {
                /** @var \SimpleXMLElement $result */
                if ($result->getName() === 'default') continue;

                $biomeandplanet = self::parseBiomeAndPlanet($result->getName());
                if ($biomeandplanet === false) {
                    file_put_contents(__DIR__ . $this->errorFile, $result->getName() . "\n", FILE_APPEND);
                    continue;
                }

                $biome = $this->biomeManager->findOneBy(array('kspkey' => strtolower($biomeandplanet['biome'])));
                if ($biome instanceof Entity\Biome) {
                    $science = new Document\Science;
                    $science
                        ->setBiome($biome)
                        ->setTech($tech);
                    $sciences[] = $science;
                } else {
                    file_put_contents(__DIR__ . $this->errorFile, $result->getName() . "\n", FILE_APPEND);
                }
            }
        }

        return $sciences;
    }

    public function parsePersistentFile(UploadedFile $file)
    {
        $xml = $this->parseFile($file, 'persistent');
        if ($xml === false) {
            return false;
        }



    }

    /**
     * @param UploadedFile $file
     * @param $root
     * @return \SimpleXMLElement|false
     */
    private function parseFile(UploadedFile $file, $root)
    {
        $xml = new \XMLWriter;
        $xml->openMemory();

        $xml->startDocument();
        $xml->startElement($root);

        $content = file_get_contents($file->getRealPath());

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

    /**
     * @param $string
     * @return array|bool
     */
    static public function parseBiomeAndPlanet($string)
    {
        $splits = preg_split('/([[:upper:]][[:lower:]]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);

        $planet = implode('', array_slice($splits, 0, 1));
        $biome = implode('', array_slice($splits, 1));

        switch($biome) {
            case 'LooInSpace':
                $planet = ucfirst(strtolower(implode('', array_slice($splits, 0, 2))));
                $biome = implode('', array_slice($splits, 2));
                break;
            case 'Space':
            case '':
                return false;
        }

        switch(strtolower($planet)) {
            case 'kering':
                return false;
            case 'eeeloo':
                $planet = 'eeloo';
                break;
        }

        return array('planet' => $planet, 'biome' => $biome);

    }

} 