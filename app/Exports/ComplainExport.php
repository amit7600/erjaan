<?php

namespace App\Exports;

use App\FeedBackComplains;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComplainExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $complains = FeedBackComplains::orderBy('id', 'asc');

        if ($this->request->get('status') != null) {
            $complains = $complains->where('status', $this->request->get('status'));
        }
        if ($this->request->get('user') != null) {
            $complains = $complains->where('user_id', $this->request->get('user'));
        }
        if ($this->request->get('user_role') != null) {
            $complains = $complains->where('role_id', $this->request->get('user_role'));
        }
        if ($this->request->get('created_from') != null && $this->request->get('created_to') != null) {
            $created_from = date('Y/m/d', strtotime($this->request->get('created_from')));
            $created_to = date('Y/m/d', strtotime($this->request->get('created_to')));
            $complains = $complains->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
        }
        return view('exports.all_complaints', [
            'complains' => $complains->get(),
        ]);

    }
}
