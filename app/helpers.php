<?php

function list_bulan()
{
    return [
        1=>'Januari',
        2=>'Februari',
        3=>'Maret',
        4=>'April',
        5=>'Mei',
        6=>'Juni',
        7=>'Juli',
        8=>'Agustus',
        9=>'September',
        10=>'Oktober',
        11=>'November',
        12=>'Desember',
    ];
}

function make_datatable($query, $columns, $column_search = [], $return_query = false)
{
    $order_by = $columns[request()->input('order.0.column')];

    if (request('search.value', false) && count($column_search) > 0) {
        $query->where(function ($q) use ($column_search) {
            $q->whereRaw('LOWER(' . $column_search[0] . ') like ? ', ['%' . strtolower(request()->input('search.value')) . '%']);
            foreach ($column_search as $key => $columns) {
                if ($key == 0) continue;
                $q->orWhereRaw('LOWER(' . $columns . ') like ? ', ['%' . strtolower(request()->input('search.value')) . '%']);
            }
        });
    }

    $data = clone $query;
    $records_filtered = $data->count();
    if (request()->input('length') != -1) $data = $data->skip(request()->input('start'))->take(request()->input('length'));
    if (!is_array($order_by)) {
        $data = $data->orderBy($order_by, request()->input('order.0.dir'));
    } else {
        foreach ($order_by as $o) {
            $data = $data->orderBy($order_by, request()->input('order.0.dir'));
        }
    }

    $data = $data->get();
    $records_total = $data->count();
    $result = [
        'draw' => request()->input('draw'),
        'recordsTotal' => $records_total,
        'recordsFiltered' => $records_filtered,
        'data' => $data
    ];
    if($return_query){
        $result['query'] = $query;
    }
    return $result;
}