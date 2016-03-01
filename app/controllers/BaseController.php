<?php

class BaseController extends Controller
{
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
        View::share('currentUser', Auth::user());
    }

    /**
     * Method who is checking if this user is admin or teacher
     * @param $author_id
     */
    public function authorOrAdminPermissionRequire($author_id)
    {
        if (Auth::user()->status != 3 && $author_id != Auth::user()->user_id) {
            App::abort(403, 'Unauthorized action.');
        }
    }
}