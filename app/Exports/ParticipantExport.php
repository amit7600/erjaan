<?php

namespace App\Exports;

use App\Participant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantExport implements FromView
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
        $participants = Participant::select('*')
            ->where('is_deleted', 0)
            ->orderBy('id', 'asc');

        if ($this->request->get('category_id') != null) {
            $participants->where('category_id', $this->request->get('category_id'));
        }

        if ($this->request->get('sub_category_id') != null) {
            $participants->where('sub_category_id', $this->request->get('sub_category_id'));
        }

        if ($this->request->get('location_id') != null) {
            $participants->where('location_id', $this->request->get('location_id'));
        }

        if ($this->request->get('group_id') != null) {
            $participants->where('group_id', $this->request->get('group_id'));
        }

        if ($this->request->get('type_id') != null) {
            $participants->where('type_id', $this->request->get('type_id'));
        }

        if ($this->request->get('gender') != null) {
            $participants->where('gender', $this->request->get('gender'));
        }

        if ($this->request->get('search_filter_value') != null) {
            $participants->where(function ($q) use ($extraData) {
                $q->where(DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'), 'like', "%" . $this->request->get('search_filter_value') . "%");
                $q->orWhere('email', $this->request->get('search_filter_value'));
                $q->orWhere('mobile', $this->request->get('search_filter_value'));
            });
        }
        return view('exports.all_participant', [
            'participants' => $participants->get(),
        ]);
    }
}
