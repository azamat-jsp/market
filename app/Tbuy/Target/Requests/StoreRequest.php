<?php

namespace App\Tbuy\Target\Requests;

use App\Enums\MorphType;
use App\Tbuy\Target\DTOs\TargetDTO;
use App\Tbuy\Target\Enums\Targetable;
use App\Tbuy\Target\Rules\CheckTargetableType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $targetable = $this->getTargetable();

        return [
            'audience_id' => ['required', 'int', Rule::exists('audiences', 'id')],
            'targetable_type' => ['required', new Enum(MorphType::class), new CheckTargetableType],
            'targetable_id' => ['required', 'int', Rule::exists($targetable, 'id')],
            'name' => ['required', 'array'],
            'name.ru' => ['required', 'string', 'max:100'],
            'name.en' => ['required', 'string', 'max:100'],
            'name.hy' => ['required', 'string', 'max:100'],
            'link' => ['required', 'string'],
            'duration' => ['required', 'int', 'max:-1', 'min:-30'],
            'started_at' => ['required', 'date'],
            'finished_at' => ['required', 'date']
        ];
    }

    public function toDto(): TargetDTO
    {
        $payload = $this->validated();
        $payload['targetable_type'] = MorphType::getType($payload['targetable_type']);

        return new TargetDTO(...$payload);
    }

    private function getTargetable(): string
    {
        $type = $this->input('targetable_type');
        $class = MorphType::getClass($type);

        return app($class)->getTable();
    }
}
