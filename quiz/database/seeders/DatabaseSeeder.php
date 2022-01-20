<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choices')->delete();
        DB::table('questions')->delete();


        $question1 = Question::create([
            'uuid' => '1',
            'text' => 'Последовательность команд, реализующая алгоритм решения задачи это ...',
            'type_input' => 'radio'
        ]);

        $question2 = Question::create([
            'uuid' => '2',
            'text' => 'Это последовательность действий для исполнителя,
	                    записанная на формальном языке и приводящая
	                    к заданной цели за конечное время.',
            'type_input' => 'radio'
        ]);

        $question3 = Question::create([
            'uuid' => '3',
            'text' => 'Что переводит текст программы в байт код?',
            'type_input' => 'radio'
        ]);

        $question4 = Question::create([
            'uuid' => '4',
            'text' => 'Укажите, какие спецификаторы доступа не существуют:',
            'type_input' => 'checkbox'
        ]);

        $question5 = Question::create([
            'uuid' => '5',
            'text' => 'Какие из понятий относятся к принципам ООП?',
            'type_input' => 'checkbox'
        ]);

        $data = [
            ['question_id' => $question1->id, 'uuid' => 'A.', 'text' => 'Консоль', 'is_correct' => false],
            ['question_id' => $question1->id, 'uuid' => 'B.', 'text' => 'Программа', 'is_correct' => true],
            ['question_id' => $question1->id, 'uuid' => 'C.', 'text' => 'Класс', 'is_correct' => false],
            ['question_id' => $question1->id, 'uuid' => 'D.', 'text' => 'Параметр', 'is_correct' => false],

            ['question_id' => $question2->id, 'uuid' => 'A.', 'text' => 'Алгоритм', 'is_correct' => true],
            ['question_id' => $question2->id, 'uuid' => 'B.', 'text' => 'Цикл', 'is_correct' => false],
            ['question_id' => $question2->id, 'uuid' => 'C.', 'text' => 'Шаблон', 'is_correct' => false],
            ['question_id' => $question2->id, 'uuid' => 'D.', 'text' => 'Логирование', 'is_correct' => false],

            ['question_id' => $question3->id, 'uuid' => 'A.', 'text' => 'Компилятор', 'is_correct' => true],
            ['question_id' => $question3->id, 'uuid' => 'B.', 'text' => 'Валидатор', 'is_correct' => false],
            ['question_id' => $question3->id, 'uuid' => 'C.', 'text' => 'Архитектор', 'is_correct' => false],
            ['question_id' => $question3->id, 'uuid' => 'D.', 'text' => 'Объект', 'is_correct' => false],

            ['question_id' => $question4->id, 'uuid' => 'A.', 'text' => 'public', 'is_correct' => false],
            ['question_id' => $question4->id, 'uuid' => 'B.', 'text' => 'private', 'is_correct' => false],
            ['question_id' => $question4->id, 'uuid' => 'C.', 'text' => 'basic', 'is_correct' => true],
            ['question_id' => $question4->id, 'uuid' => 'D.', 'text' => 'open', 'is_correct' => true],

            ['question_id' => $question5->id, 'uuid' => 'A.', 'text' => 'Полиморфизм', 'is_correct' => true],
            ['question_id' => $question5->id, 'uuid' => 'B.', 'text' => 'Имплементация', 'is_correct' => false],
            ['question_id' => $question5->id, 'uuid' => 'C.', 'text' => 'Инкапсуляция', 'is_correct' => true],
            ['question_id' => $question5->id, 'uuid' => 'D.', 'text' => 'Рефакторинг', 'is_correct' => false],
        ];

        Choice::insert($data);
    }
}
