<?php

namespace App\Rules;

use App\Models\SchoolYear;
use Illuminate\Contracts\Validation\Rule;

class SchoolYearRule implements Rule
{
    public $cMessage = 'please enter valid :attribute.';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $from = request()->from;
        $to = request()->to;

        $schoolYear = SchoolYear::where([
            'from' => $from,
            'to' => $to,
        ])->exists();

        if ($from > $to) {
            return false;
        }

        if ($schoolYear) {
            $this->cMessage = 'School year is already exists!';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->cMessage;
    }
}
