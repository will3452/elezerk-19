<?php

namespace App\Nova\Actions;

use App\Models\Section;
use App\Models\StudentGrade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Http\Requests\NovaRequest;

class SubmitGrade extends Action
{
    use InteractsWithQueue, Queueable;

    public $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            StudentGrade::create([
                'subject_id' => $fields->subject_id,
                'student_id' => $model->student_id,
                'section_id' => $this->section->id,
                'grade' => $fields->grade,
                'remarks' => $fields->remarks,
                'enrollment_id' => $model->id,
                'academic_year_id' => $model->academic_year_id,
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        if (auth()->user()->type == User::TYPE_ADMIN) {
            return [];
        }
        $loads = auth()->user()->employee->teachingLoads()->whereSectionId($this->section->id)->select('subject_id')->get();

        $subjects = Subject::whereIn('id', $loads->map(fn ($e) => $e->subject_id)->all())->get()->pluck('name', 'id');

        return [
            Select::make('Subject', 'subject_id')
                ->options($subjects),
            Number::make('Grade')
                ->rules(['required']),
            Textarea::make('Remarks'),
        ];
    }
}
