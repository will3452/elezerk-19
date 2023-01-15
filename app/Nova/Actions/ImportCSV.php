<?php

namespace App\Nova\Actions;

use App\Models\Trainee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class ImportCSV extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $file = $fields['csv']->store('public');

        $csv = fopen(storage_path("/app/" . $file), 'r');

        $data = [];

        while (! feof($csv)) {
            [$firstName, $lastName, $middleName, $schoolYear, $studentNo, $section, $email] = fgetcsv($csv);

            if (is_null($firstName)) {
                continue;
            }

            $data[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'middle_name' => $middleName,
                'school_year' => $schoolYear,
                'student_no' => $studentNo,
                'section' => $section,
                'email' => $email,
            ];

        }
        fclose($csv);

        foreach ($data as $d) {
            Trainee::create($d);
        }

        return Action::message('CSV imported!');

    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            File::make('CSV', 'csv')
                ->acceptedTypes('csv'),
        ];
    }
}
