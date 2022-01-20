<?php

namespace App\Http\Controllers;

use App\DTO\AnswerDTO;
use App\DTO\AnswersDTO;
use App\DTO\ChoiceDTO;
use App\DTO\QuestionDTO;
use App\DTO\QuizDTO;
use App\Models\Choice;
use App\Models\Question;
use App\Service\QuizResultService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Получение первого вопроса и редирект на вывод
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function start(Request $request)
    {
        $request->session()->put('answers', []); //обнуляем данные в сессии

        $question = Question::query()->orderBy('uuid')->first();

        return redirect()->route('questions.show', ['uuid' => $question->uuid]);
    }

    /**
     * Вывод вопроса
     *
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($uuid)
    {
        $questionDb = Question::where('uuid', '=', $uuid)->first();

        $questionDTO = new QuestionDTO(
            $questionDb->uuid,
            $questionDb->text
        );

        $choicesDb = Choice::where('question_id', $questionDb->id)
            ->orderBy('uuid')
            ->get();

        foreach ($choicesDb as $choiceTest) {
            $choice12345 = new ChoiceDTO(
                $choiceTest->uuid,
                $choiceTest->text,
                $choiceTest->is_correct

            );

            $questionDTO->addChoice($choice12345);
        }

        return view('questions-show', ['question' => $questionDTO, 'type_input' => $questionDb->type_input]);
    }

    /**
     * Сохранение ответа на текущий вопрос в сессию и редирект на вывод следующего вопроса,
     * если след вопроса нет, то редирект на вывод результата
     *
     * @param $uuid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function next($uuid, Request $request)
    {
        $data = $request->session()->get('answers', []);
        $data[$uuid] = (array)$request->answer;

        $request->session()->put('answers', $data);

        $questionCurrent = Question::where('uuid', '=', $uuid)->first();
        $questionNext = Question::query()
            ->orderBy('uuid')
            ->where('uuid', '>', $questionCurrent->uuid)
            ->first();

        if (is_null($questionNext)) {
            return redirect()->route('end', ['data' => $data]);
        }

        return redirect()->route('questions.show', ['uuid' => $questionNext->uuid]);
    }

    /**
     * Редирект на вывод предыдущего вопроса, если пред вопроса нет, то вывод главной
     *
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function prev($uuid)
    {
        $questionCurrent = Question::where('uuid', '=', $uuid)->first();
        $questionPrev = Question::query()
            ->orderByDesc('uuid')
            ->where('uuid', '<', $questionCurrent->uuid)
            ->first();

        if (is_null($questionPrev)) {

            return view('welcome');
        }

        return redirect()->route('questions.show', ['uuid' => $questionPrev->uuid]);
    }

    /**
     * Вывод результат
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function end(Request $request)
    {
        $quiz = new QuizDTO('1', 'Test1');

        $questionsDb = Question::query()->get();
        $choicesDb = Choice::query()->get();


        foreach ($questionsDb as $question) {
            $questionDTO = new QuestionDTO(
                $question->uuid,
                $question->text
            );

            foreach ($choicesDb as $choiceTest) {
                if ($choiceTest->question_id == $question->id) {
                    $choice = new ChoiceDTO(
                        $choiceTest->uuid,
                        $choiceTest->text,
                        $choiceTest->is_correct
                    );

                    $questionDTO->addChoice($choice);
                }
            }

            $quiz->addQuestion($questionDTO);
        }

        $data = $request->session()->get('answers', []);

        $answers = new AnswersDTO($quiz->getUUID());

        foreach ($data as $uuid => $userAnswers) {
            $answerDTO = new AnswerDTO($uuid);

            foreach ($userAnswers as $userAnswer) {
                $answerDTO->addChoiceUUID($userAnswer);
            }

            $answers->addAnswer($answerDTO);
        }

        $quizResultService = new QuizResultService($quiz, $answers);
        $result = $quizResultService->getResult();

        return view('goodbye', ['result' => $result]);
    }
}
