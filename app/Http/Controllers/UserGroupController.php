<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class UserGroupController extends Controller
{
    //

    public function userGroups()
    {
        $this->pageSetting( [
            'menu_group_id' => 50,
            'menu_id' => 1,
            'title' => 'จัดการกลุ่มผู้ใช้ | จัดการผู้ใช้'
        ] );

        //$user_group = DB::table('TBL_PRIVILEGE')->skip(10)->take(5)->where('USER_PRIVILEGE_ID',0)->get();

        //$query = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC');
        //$dd = $query->skip(1)->take(2)->get();
        //dd($dd);
        return view('backend.pages.user_group');
    }

    public function getUserGroups(Request $request)
    {
        $records = [];
        $records["data"] = [];
        //$filters = [];

        $query = DB::table('TBL_PRIVILEGE')->select('USER_PRIVILEGE_ID','USER_PRIVILEGE_DESC');

//        $sql = "SELECT a.*,b.`prefix`,b.`first_name`,b.`last_name`,b.`email` FROM `orders` a LEFT JOIN `customers` b ON a.`customer_id` = b.`customer_id` ";

//        if (!empty($request->input('order_id'))) {
//            $filters[] = " a.order_id = " . $request->input('order_id');
//        }
//        if (!empty($request->input('order_date_from')) && !empty($request->input('order_date_to'))) {
//            $filters[] = " a.order_date BETWEEN '" . $request->input('order_date_from') . " 00:00:00' AND '" . $request->input('order_date_to') . " 23:59:59'";
//        }
//        if (!empty($request->input('order_customer_name'))) {
//            $filters[] = " b.first_name LIKE '%" . $request->input('order_customer_name') . "%' OR b.last_name LIKE '%" . $request->input('order_customer_name') . "%'";
//            //$filters[] = " b.first_name = '".$request->input('order_customer_name')."'";
//        }
//        if (!empty($request->input('order_grand_total_from')) && empty($request->input('order_grand_total_to'))) {
//            $filters[] = " a.grand_total >= " . $request->input('order_grand_total_from');
//        } elseif (empty($request->input('order_grand_total_from')) && !empty($request->input('order_grand_total_to'))) {
//            $filters[] = " a.grand_total <= " . $request->input('order_grand_total_to');
//        } elseif (!empty($request->input('order_grand_total_from')) || !empty($request->input('order_grand_total_to'))) {
//            $filters[] = " a.grand_total BETWEEN '" . $request->input('order_grand_total_from') . "' AND '" . $request->input('order_grand_total_to') . "'";
//        }
//
//        if (!empty($request->input('shipping_date_from')) && !empty($request->input('shipping_date_to'))) {
//            $filters[] = " a.order_shipping_date BETWEEN '" . $request->input('shipping_date_from') . " 00:00:00' AND '" . $request->input('shipping_date_to') . " 23:59:59'";
//        }
//
//        if (!empty($request->input('shipping_no'))) {
//            $filters[] = " a.order_shipping_id LIKE '%" . $request->input('shipping_no') . "%'";
//        }
//        if ($request->input('order_status') && $request->input('order_status') != '-1') {
//            $filters[] = " a.order_status = '" . $request->input('order_status') . "'";
//        }
//        if (count($filters) > 0) {
//            $sql .= " WHERE";
//            foreach ($filters as $key => $filter) {
//                if ($key > 0) {
//                    $sql .= " AND";
//                }
//                $sql .= $filter;
//            }
//        }

        $total = $query->count();
        $total = count($total);
        $limit = intval($request->input('length'));
        $limit = $limit < 0 ? $limit : $limit;
        $iDisplayStart = intval($request->input('start'));
        $sEcho = intval($request->input('draw'));

        $order = $request->input('order');
        $orderColumns = [
            1 => 'USER_PRIVILEGE_ID',
            2 => 'USER_PRIVILEGE_DESC'
        ];
        if ($order) {
            //$sql .= " ORDER BY {$orderColumns[$order[0]['column']]} {$order[0]['dir']}";
            $query->orderBy($orderColumns[$order[0]['column']], $order[0]['dir']);
        } else {
            //$sql .= " ORDER BY a.`order_id` DESC";
            $query->orderBy('USER_PRIVILEGE_ID', 'desc');
        }
        //$sql .= " LIMIT $iDisplayStart, $limit";

        $user_groups = $query->skip($iDisplayStart)->take($limit)->get();

        //$orders = DB::select(DB::raw($sql));

        $order_status = [
            'on-hold' => 'On Hold',
            'pending' => 'Pending Payment',
            'pending-shipping' => 'Pending Shipping',
            'pre-order' => 'Pre Order',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
        $status_color = [
            'on-hold' => 'on-hold',
            'pending' => 'pending',
            'pending-shipping' => 'pending-shipping',
            'pre-order' => 'pre-order',
            'completed' => 'completed',
            'cancelled' => 'cancelled'
        ];
        if ($user_groups) {
            foreach ($user_groups as $group) {
                $records["data"][] = [
                    sprintf('<input type="checkbox" name="id[]" value="%1$s">', $group->USER_PRIVILEGE_ID),
                    $group->USER_PRIVILEGE_ID,
                    $group->USER_PRIVILEGE_DESC,
                    sprintf('<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-pencil"></i>&nbsp;แก้ไข</a><a href="javascript:;" class="btn btn-sm btn-outline red-thunderbird"><i class="fa fa-remove"></i>&nbsp;ลบ</a>')
                ];
            }
        }
        if ($request->input('customActionType') && $request->input('customActionType') == "group_action" && $request->input('customActionName') != "-1") {
            if (count($request->input('id')) > 0) {
                $update_result = DB::table('orders')->whereIn('order_id', $request->input('id'))->update(['order_status' => $request->input('customActionName')]);
                if ($update_result) {
                    $records["customActionStatus"] = "OK";
                    $records["customActionMessage"] = "Update orders status successfully has been completed. Well done!";
                } else {
                    $records["customActionStatus"] = "Errors";
                    $records["customActionMessage"] = "Cannot update orders status. Please try again!";
                }
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $total;
        $records["recordsFiltered"] = $total;
        return response()->json($records);
    }

}
