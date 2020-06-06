<?php

namespace App\Controller;

use App\Entity\Paragraph;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class ParagraphController extends AbstractController
{
    /**
     * @Route("/paragraph", name="paragraph")
     */
    public function index()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $handle = fopen("../001.json", "r");
        $contents = fread($handle, filesize("../001.json"));
        /*
        $paragraph = $serializer->deserialize($contents, Paragraph::class, 'json');
        var_dump($contents);
        */

        $data = json_decode($contents, true);
        $paragraphs = array();
        foreach($data['paragraph'] as $result) :
            $paragraph = new Paragraph();
            $paragraph->setName($result['name']);
            $paragraph->setContext($result['context']);
            $paragraph->setProfession($result['profession']);
            $paragraph->setAppointed($result['appointed']);
            $paragraphs[] = $paragraph;
        endforeach;
        var_dump($paragraphs[0]);
        return $this->render('paragraph/index.html.twig', [
            'controller_name' => 'ParagraphController',
            'contents' => $contents,
        ]);
    }
}
