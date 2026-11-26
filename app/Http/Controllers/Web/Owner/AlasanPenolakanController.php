<?php

namespace App\Http\Controllers\Web\Owner;

use App\Domain\Reference\LeaveRejectionReasons;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LeaveRejectionReasonIndexRequest;
use App\Http\Requests\Web\Owner\StoreReasonRequest;
use App\Http\Requests\Web\Owner\UpdateReasonRequest;
use App\Models\LeaveRejectionReason;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AlasanPenolakanController extends Controller
{
    public function index(LeaveRejectionReasonIndexRequest $request): View
    {
        $status = $request->validated('status', 'all');
        $search = $request->validated('search');

        return view('owner.alasan-penolakan', [
            'reasons' => LeaveRejectionReasons::listing($status, $search),
            'status' => $status,
            'search' => $search,
            // Urutan hanya dapat diubah saat seluruh daftar tampil.
            'canReorder' => $status === 'all' && blank($search),
        ]);
    }

    public function store(StoreReasonRequest $request): RedirectResponse
    {
        $reason = LeaveRejectionReasons::create($request->validated());

        return to_route('owner.alasan-penolakan')->with('status', "Alasan \"{$reason->name}\" ditambahkan.");
    }

    public function update(UpdateReasonRequest $request, LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::update($leaveRejectionReason, $request->validated());

        return back()->with('status', 'Alasan disimpan.');
    }

    public function moveUp(LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::move($leaveRejectionReason, -1);

        return back();
    }

    public function moveDown(LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::move($leaveRejectionReason, 1);

        return back();
    }

    public function deactivate(LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::deactivate($leaveRejectionReason);

        return back()->with('status', "\"{$leaveRejectionReason->name}\" dinonaktifkan. Data lama tetap menampilkannya.");
    }

    public function activate(LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::activate($leaveRejectionReason);

        return back()->with('status', "\"{$leaveRejectionReason->name}\" diaktifkan kembali.");
    }

    public function destroy(LeaveRejectionReason $leaveRejectionReason): RedirectResponse
    {
        LeaveRejectionReasons::delete($leaveRejectionReason);

        return back()->with('status', "\"{$leaveRejectionReason->name}\" dihapus.");
    }
}
