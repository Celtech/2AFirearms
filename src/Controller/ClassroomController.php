<?php

namespace App\Controller;

use App\Entity\ClassRoom;
use App\Entity\Lessons;
use App\Entity\QuizQuestions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClassroomController extends AbstractController
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/classroom", name="classroom")
     */
    public function index()
    {
        return $this->render('pages/classroom/classroom.html.twig', [

        ]);
    }

    /**
     * @Route("/classroom/lesson/{id}", name="classroom_lesson", requirements={"id"="\d+"})
     */
    public function lessons($id = 1)
    {
        $classroom = $this->entityManager->getRepository(ClassRoom::class)->findOneBy(['user_id' => $this->getUser()->getId()]);
        if ($classroom === null) {
            $classroom = new ClassRoom();
            $classroom->setUserId($this->getUser()->getId());
            $classroom->setStep($id);
            $classroom->setIsCompleted(0);
            $classroom->setDateStarted(new \DateTime());
            $this->entityManager->persist($classroom);
            $this->entityManager->flush();
        } else {
            $classroom->setStep($id);
            $this->entityManager->persist($classroom);
            $this->entityManager->flush();
        }

        $lesson = $this->entityManager->getRepository(Lessons::class)->find($id);
        return $this->render('pages/classroom/lesson.html.twig', [
            'lesson' => $lesson,
            'id' => $id
        ]);
    }

    /**
     * @Route("/classroom/quiz", name="classroom_quiz")
     */
    public function quiz(Request $request)
    {
        $questions = $this->entityManager->getRepository(QuizQuestions::class)->findAll();
        if ($request->isMethod('post')) {
            $answers = $request->get("option");
            $score = 0;

            for ($i = 0; $i < count($questions); $i++) {
                if ($answers[$i + 1] == $questions[$i]->getCorrectAnswer()) {
                    $score++;
                }
            }

            $classroom = $this->entityManager->getRepository(ClassRoom::class)->findOneBy(['user_id' => $this->getUser()->getId()]);
            $classroom->setScore($score);
            $classroom->setIsCompleted(1);
            $classroom->setStep(10);
            $classroom->setDateCompleted(new \DateTime());
            $this->entityManager->persist($classroom);
            $this->entityManager->flush();
            return $this->redirectToRoute("classroom_quiz_complete");
        }

        return $this->render('pages/classroom/quiz.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/classroom/quiz/complete", name="classroom_quiz_complete")
     */
    public function quizCompleted()
    {
        $classroom = $this->entityManager->getRepository(ClassRoom::class)->findOneBy(['user_id' => $this->getUser()->getId()]);
        return $this->render('pages/classroom/quiz_results.html.twig', [
            'score' => $classroom->getScore()
        ]);
    }
}
