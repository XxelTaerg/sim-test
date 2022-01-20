<?php

namespace App\Service;

use App\DTO\QuizDTO;
use App\DTO\QuestionDTO;
use App\DTO\ChoiceDTO;
use App\DTO\AnswersDTO;
use App\DTO\AnswerDTO;

use Exception;

class QuizResultService
{
    private QuizDTO $quiz;
    private AnswersDTO $answers;

    public function __construct(QuizDTO $quiz, AnswersDTO $answers)
    {
        $this->quiz = $quiz;
        $this->answers = $answers;
    }

    public function getResult(): float
    {
        $percent = 0;

        // your code here
        foreach ($this->quiz->getQuestions() as $question) {
            $countRightQuestions = 0;

            foreach ($question->getChoices() as $choice) {
                if ($choice->isCorrect()) {
                    $countRightQuestions++;
                }
            }

            foreach ($this->answers->getAnswers() as $answer) {
                $countRightAnswers = count($answer->getСhoices());

                if ($answer->getQuestionUUID() == $question->getUUID()) {
                    if ($countRightQuestions == count($answer->getСhoices())) {
                        foreach ($question->getChoices() as $choice) {
                            if (in_array($choice->getUUID(), $answer->getСhoices()) && $choice->isCorrect()) {
                                $countRightAnswers--;
                            }
                        }

                        if ($countRightAnswers == 0) {
                            $percent++;
                        }
                    }
                }
            }
        }

        return $percent/count($this->quiz->getQuestions());
    }
}
