<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Paragraph;
use App\Entity\Position;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/paragraph")
 */
class ParagraphController extends AbstractController
{
    /**
     * @Route("/", name="paragraph_index", methods={"GET"})
     */
    public function index()
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $handle = fopen("../incoming_files/001.json", "r");
        $contents = fread($handle, filesize("../incoming_files/001.json"));

        // windows-1251
        $contents = iconv('utf-8',"UTF-8//IGNORE", $contents);

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

        return $this->render('paragraph/index.html.twig', [
            'controller_name' => 'ParagraphController',
            'paragraphs' => $paragraphs
        ]);
    }

    /**
     * @Route("/{id}", name="paragraph_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $position = $this->getDoctrine()
            ->getRepository(Position::class)
            ->findBy([
                'id' => $id
            ]);

        $document = $this->getDoctrine()
            ->getRepository(Document::class)
            ->findBy([
                'positionId' => $position[0]->getId()
        ]);

        return $this->render($document[0]->getSrcHtml(), [
            'controller_name' => 'ParagraphController',
        ]);
    }
}
