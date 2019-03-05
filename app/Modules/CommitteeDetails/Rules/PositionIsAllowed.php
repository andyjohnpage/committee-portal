<?php

namespace App\Modules\CommitteeDetails\Rules;

class PositionIsAllowed extends HandlesCommitteeRoleFormBaseRule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     *
     */
    public function passes($attribute, $value)
    {

        // Check position is allowed
        return $this->positionIsAllowed();

    }

    /**
     * Check settings to see if the position is allowed
     *
     * @return bool
     */
    public function positionIsAllowed()
    {
        return $this->checkInPositionSettings($this->position->id, $this->positionSetting->allowed_positions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Position is not available for your group type.';
    }
}
