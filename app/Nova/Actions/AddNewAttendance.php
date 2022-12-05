<?php

namespace App\Nova\Actions;

use App\Models\Section;
use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use App\Models\Attendance;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddNewAttendance extends Action
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
        return Attendance::create([
            'student_id' => $fields->student,
            'subject_id' => $fields->subject_id,
            'section_id' => $this->section->id,
            'remarks' => $fields->remarks,
        ]);
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $this->section->load('enrolledStudents');
        $studentIds = $this->section->enrolledStudents->map( fn ($e) => $e->student_id)->all();

        $loads = auth()->user()->employee->teachingLoads()->whereSectionId($this->section->id)->select('subject_id')->get();

        $subjects = Subject::whereIn('id', $loads->map(fn ($e) => $e->subject_id)->all())->get()->pluck('name', 'id');
        return [
            Select::make('Student')
                ->options(\App\Models\Student::whereIn('id', $studentIds)->get()->map( fn ($e) => ['name' => "$e->studentId - $e->last_name, $e->first_name", 'id' => $e->id])->pluck('name', 'id')),
            Select::make('Subject', 'subject_id')
                ->options($subjects),
            Textarea::make('Remarks')
                ->rules(['required'])
        ];
    }
}
