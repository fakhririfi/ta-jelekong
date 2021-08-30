<?php

namespace App\Http\Controllers;

use App\DetailCheckList;
use App\DetailTahap;
use App\Tahap;
use App\Event;
use App\DetailMember;
use App\User;
use Illuminate\Http\Request;

class ManageEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        return view('admin.planning.index')->with([
            'events' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:255',
            'event_id' => 'required'
        ]);

        $tahap = Tahap::create([
            'nama' => $request->nama,
            'event_id' => $request->event_id,
        ]);


        if ($tahap) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }
    public function storeDetail(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:255',
            'tahap_id' => 'required'
        ]);

        $detail = DetailTahap::create([
            'nama' => $request->nama,
            'tahap_id' => $request->tahap_id,
        ]);

        $member =  DetailMember::create([
            'user_id' =>  $request->user()->id,
            'detail_tahap_id' => $detail->id,
        ]);

        if ($detail && $member) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }
    public function addMember(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'detail_id' => 'required'
        ]);

        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $request->detail_id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menambah member karena anda bukan member'
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal menambah'
            ]);
        }
        $member =  DetailMember::create([
            'user_id' =>  $user->id,
            'detail_tahap_id' => $request->detail_id,
        ]);

        if ($member) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }

    public function addCheckList(Request $request)
    {
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $request->detail_id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menambah list karena anda bukan member'
            ]);
        }
        $this->validate($request, [
            'nama' => 'required|max:255',
        ]);

        $checkList =  DetailCheckList::create([
            'nama' => $request->nama,
            'detail_tahap_id' => $request->detail_id,
        ]);
        if ($checkList) {
            return redirect()->back()->with([
                'success' => 'Berhasil Menyimpan'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal Menyimpan Data'
            ]);
        }
    }


    public function deleteMember($detail_id, $user_id, Request $request)
    {
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $detail_id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menghapus member karena anda bukan member'
            ]);
        }
        $lastman = DetailMember::where('detail_tahap_id', $detail_id)->get();
        if (count($lastman) == 1) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menghapus member '
            ]);
        }
        $member = DetailMember::where('user_id', $user_id)->where('detail_tahap_id', $detail_id)->first();
        $member->delete();

        if ($member) {
            return redirect()->back()->with([
                'success' => 'Berhasil menghapus'
            ]);
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Gagal menghapus'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->with('tahaps', 'tahaps.details')->first();
        return view('admin.planning.manage')->with([
            'event' => $event
        ]);
    }

    public function showDetail($id)
    {
        $detail = DetailTahap::where('id', $id)->with('members')->first();
        $checklist = DetailCheckList::where('detail_tahap_id', $id)->get();
        $persentase = 0;
        $checked = 0;
        foreach ($checklist as $value) {
            if ($value->completed) {
                $checked++;
            }
        }
        if (count($checklist) > 0) {

            $persentase = $checked / count($checklist) * 100;
        }
        return response()->json(['data' => $detail, 'checklist' => $checklist, 'persentase' => $persentase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tahap::where('id', $id)
            ->update(['nama' => $request->nama]);
        return response()->json(['message' => 'Berhasil']);
    }
    public function updateDetail(Request $request, $id)
    {
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa mengubah detail karena anda bukan member'
            ]);
        }
        DetailTahap::where('id', $id)
            ->update(['nama' => $request->nama, 'deskripsi' => $request->deskripsi]);
        return redirect()->back()->with([
            'success' => 'Berhasil Menyimpan'
        ]);
    }
    public function toggleChecklist($id, Request $request)
    {

        $checklist = DetailCheckList::where('id', $id)->first();
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $checklist->detail_tahap_id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa mengubah karena anda bukan member'
            ]);
        }
        DetailCheckList::where('id', $id)
            ->update(['completed' => !$checklist->completed]);
        return redirect()->back()->with([
            'success' => 'Berhasil Menyimpan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        $tahap =  Tahap::where('id', $id);
        $tahap->delete();

        return redirect()->back()->with([
            'success' => "Berhasil Menghapus"
        ]);
    }
    public function destroyDetail($id, Request $request)
    {
        $detail = DetailTahap::where('id', $id)->first();
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $id)
            ->first();

        if (!$check && $request->user()->role != "admin") {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menghapus karena anda bukan member'
            ]);
        }
        $detail->delete();

        return redirect()->back()->with([
            'success' => "Berhasil menghapus"
        ]);
    }
    public function destroyChecklist($id, Request $request)
    {
        $checklist =  DetailCheckList::where('id', $id)->first();
        $check = DetailMember::where('user_id', $request->user()->id)
            ->where('detail_tahap_id', $checklist->detail_tahap_id)
            ->first();

        if (!$check) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menghapus karena anda bukan member'
            ]);
        }
        $checklist->delete();

        return redirect()->back()->with([
            'success' => "Berhasil menghapus"
        ]);
    }
}
