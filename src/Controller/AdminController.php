<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, SluggerInterface $slugger)
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $rtfFile */
            $rtfFile = $form->get('src_rtf')->getData();

            if ($rtfFile) {
                $originalFilename = pathinfo($rtfFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                /** @var TYPE_NAME $safeFilename */
                $newFilename = $safeFilename.'-'.uniqid().'.'.$rtfFile->guessExtension();

                try {
                    $rtfFile->move(
                        $this->getParameter('docs_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }
                $document->setSrcRtf($newFilename);
            }

            return $this->redirect($this->generateUrl('admin'));
        }

        return $this->render('document/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}