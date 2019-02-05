<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 30/01/19
 * Time: 23:44
 */

namespace App\Traits;


use Illuminate\Support\Facades\Session;

trait LogsIntoPosition
{

    protected $positions;

    /**
     * @param $positions
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
    }

    /**
     * @return mixed
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @return mixed
     */
    public function getCurrentPosition()
    {
        $currentPosition = $this->getCurrentPositionID();
        return $this->positions[$currentPosition];
    }

    /**
     * @return int|mixed
     */
    public function getCurrentPositionID()
    {
        return (int) (Session::has('authentication.user.position.id')?Session::get('authentication.user.position.id'):0);
    }

    /**
     * @param $controlID
     * @return mixed
     */
    public function getPositionsFromControl($controlID)
    {
        $controlDB = resolve('App\Packages\ControlDB\ControlDBInterface');
        $positions = $controlDB->getPositionsFromStudent($controlID);
        return $positions;
    }


    /**
     * @param $positionNumber
     * @throws \Exception
     */
    public function loginToPosition($positionNumber)
    {
        if($positionNumber >= count($this->positions))
        {
            throw new \Exception('Unable to log you into your group', 500);
        }

        Session::put('authentication.user.position.id', $positionNumber);
    }



}