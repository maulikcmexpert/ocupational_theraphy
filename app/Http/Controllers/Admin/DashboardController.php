<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin\Group;
use App\Http\Requests\PostchangePassword;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Patient_discharge_master;

class DashboardController extends Controller
{
    public function index()
    {

        $data['page'] = 'admin.dashboard';
        $data['totalDoctor'] = User::where('role_id', 3)->count();
        $data['totalPatient'] = User::where('role_id', 5)->count();
        $data['totalGroup'] = Group::count();
        $data['totalStaff'] = User::where('role_id', 2)->count();
        $data['total_admited'] = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_admit')->groupBy('year', 'month')->where('role_id', 5)->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $data['total_discharges'] = Patient_discharge_master::selectRaw('YEAR(discharge_date) as year, MONTH(discharge_date) as month, COUNT(*) as total_discharges')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        return view('admin.main_layout', $data);
    }

    public function change_password()
    {

        $id = auth()->user()->id;

        $data['page'] = 'admin.change_password';
        $data['js'] = ['dashboard'];
        $data['adminId'] = encrypt($id);
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    public function store_change_password(PostchangePassword $request, $id)
    {

        try {

            DB::beginTransaction();

            $adminId = decrypt($id);
            $admin = User::findOrFail($adminId);

            if (!empty($admin)) {

                $admin->password = bcrypt($request->new_password);
                $admin->save();

                DB::commit();
                toastr()->success('admin"s password changed successfully !');
                return redirect()->route('admin.dashboard');
            } else {
                toastr()->error('admin not found');
                return redirect()->route('admin.changePassword', $id);
            }
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('admin.changePassword', $id);
        }
    }
}
