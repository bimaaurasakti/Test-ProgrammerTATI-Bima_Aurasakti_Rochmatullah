<?php

namespace App\Http\Controllers;

use App\DataTables\DailyLogsDataTable;
use Exception;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Dictionaries\Users\UserTypeDictionary;
use App\Http\Requests\DailyLog\DailyLogRequest;
use App\Infrastructures\Services\DailyLogService;

class DailyLogController extends Controller
{
    protected $dailyLogService;

    public function __construct()
    {
        $this->dailyLogService = new DailyLogService();

        $this->middleware('permission:daily-log-list', ['only' => ['index']]);
        $this->middleware('permission:daily-log-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:daily-log-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:daily-log-reject', ['only' => ['reject']]);
        $this->middleware('permission:daily-log-accept', ['only' => ['accept']]);
    }

    public function index(Request $request, DailyLogsDataTable $dataTable)
    {
        $pageTitle = 'Daily Log '. ($request->type ? unslugWithCapitalize($request->type) : 'Inferior') .' List';
        $auth_user = Auth::user();
        $assets = ['data-table'];
        $additionalAction = view('daily-logs.additional.action')->render();
        $headerAction = '';
        $type = $request->type ?? UserTypeDictionary::USER_TYPE_STAFF;
        if ($auth_user->can('daily-log-add')) {
            $headerAction = '<a href="'.route('daily-logs.create').'" class="btn btn-sm btn-primary" role="button">Add Daily Log</a>';
        }
        return $dataTable->with(['user' => $auth_user, 'menu' => $request->menu, 'status' => $request->status])->render('global.datatable', compact('pageTitle', 'auth_user', 'assets', 'headerAction', 'additionalAction'));
    }

    public function create(Request $request)
    {
        $dailyLog = new DailyLog();
        return view('daily-logs.form', compact('dailyLog'));
    }

    public function store(DailyLogRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->dailyLogService->craete($request->all());
            DB::commit();
            return redirect()->route('daily-logs.index', ['type' => $request->user_type])->withSuccess('Daily log created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show(Request $request, $dailyLogID)
    {
        $user = $this->dailyLogService->findById($dailyLogID, ['user']);
        return $this->edit($request, $user);
    }

    public function edit(Request $request, $dailyLogID)
    {
        $dailyLog = $this->dailyLogService->findById($dailyLogID, ['user']);
        return view('daily-logs.form', compact('dailyLog'));
    }

    public function update(DailyLogRequest $request, DailyLog $dailyLog)
    {
        try {
            DB::beginTransaction();
            $this->dailyLogService->update($dailyLog, $request->all());
            DB::commit();
            return redirect()->route('daily-logs.index')->withSuccess('Daily log updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy(DailyLog $dailyLog)
    {
        abort(404);
    }

    public function reject($dailyLogID)
    {
        try {
            $this->dailyLogService->reject($dailyLogID);
            return redirect()->back()->withSuccess('Daily log rejected successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function accept($dailyLogID)
    {
        try {
            $this->dailyLogService->accept($dailyLogID);
            return redirect()->back()->withSuccess('Daily log accepted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
