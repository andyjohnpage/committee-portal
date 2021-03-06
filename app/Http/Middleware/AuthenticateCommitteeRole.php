<?php

namespace App\Http\Middleware;

use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticateCommitteeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the user is a student, log them into committee-role
        if( !Auth::user()->isAdmin()) {

            // If they're not logged in, log them in!
            if( !Auth::guard('committee-role')->check())
            {
                $student = Student::find(Auth::user()->control_id);
                $committeeRole = CommitteeRole::allThrough($student)->first();
                abort_if($committeeRole === null, 403);
                if( !Auth::guard('committee-role')->attempt([
                    'committee_role_id'=>$committeeRole->id,
                    'student_control_id' => Auth::user()->control_id])) {
                    abort(403);
                }
            }

        }
        return $next($request);
    }
}
