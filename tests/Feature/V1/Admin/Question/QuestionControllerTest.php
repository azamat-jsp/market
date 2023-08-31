<?php

namespace Tests\Feature\V1\Admin\Question;

use App\Tbuy\Question\Enums\Permission;
use App\Tbuy\Question\Models\Question;
use App\Tbuy\User\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{

    /**
     * Test the index method to get a list of all questions and answers.
     *
     * @return void
     */
    public function test_index()
    {
        /** @var User $user */
        $user = User::query()->inRandomOrder()->first();

        $this->actingAs($user)
            ->get(route('api.v1.admin.question.index'))
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => []
            ])->assertJson([
                "success" => "true",
                "message" => "Список всех вопросов и ответов",
                "data" => []
            ]);
    }

    /**
     * Test the store method to create a new question and answer.
     *
     * @return void
     */
    public function test_store()
    {
        /** @var User $user */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::STORE_QUESTION->value);

        $question = Question::factory()->raw();

        $questionId = $this->actingAs($user)
            ->postJson(route('api.v1.admin.question.store'), $question)
            ->assertCreated()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "question",
                    "answer"
                ]
            ])
            ->json('data.id');

        $this->assertDatabaseHas('questions', [
            'id' => $questionId,
            'question->en' => $question['question']['en'],
            'question->ru' => $question['question']['ru'],
            'question->hy' => $question['question']['hy'],
            'answer->en' => $question['answer']['en'],
            'answer->ru' => $question['answer']['ru'],
            'answer->hy' => $question['answer']['hy'],
        ]);

    }

    /**
     * Test the update method to update a question and answer.
     *
     * @return void
     */
    public function test_update()
    {
        /**
         * @var User $user
         * @var Question $question
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::UPDATE_QUESTION->value);

        $question = Question::query()->inRandomOrder()->first();
        $newQuestion = Question::factory()->raw();

        $this->actingAs($user)
            ->putJson(route('api.v1.admin.question.update', $question->id), $newQuestion)
            ->assertOk()
            ->assertJsonStructure([
                "success",
                "message",
                "data" => [
                    "id",
                    "question",
                    "answer"
                ]
            ])
            ->assertJson(
                fn(AssertableJson $json) => $json->where('data.id', $question->id)->etc()
            );

        $this->assertDatabaseHas('questions', [
            'id' => $question->id,
            'question->en' => $newQuestion['question']['en'],
            'question->ru' => $newQuestion['question']['ru'],
            'question->hy' => $newQuestion['question']['hy'],
            'answer->en' => $newQuestion['answer']['en'],
            'answer->ru' => $newQuestion['answer']['ru'],
            'answer->hy' => $newQuestion['answer']['hy'],
        ]);
    }

    /**
     * Test the destroy method to delete a question and answer.
     *
     * @return void
     */

    public function testDestroy()
    {
        /**
         * @var User $user
         * @var Question $question
         */
        $user = User::query()->first();
        $user->givePermissionTo(Permission::DELETE_QUESTION->value);

        $question = Question::factory()->create();

        $this->actingAs($user)
            ->delete(route('api.v1.admin.question.destroy', $question->id))
            ->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Вопрос и ответ удалены',
            ]);

        $this->assertSoftDeleted('questions', ['id' => $question->id]);
    }
}
