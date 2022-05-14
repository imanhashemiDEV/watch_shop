<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vip;
use App\Models\VipShop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VipShopController extends Controller
{
    public function index()
    {
        $vip_shops = VipShop::query()->orderBy('id', 'DESC')->paginate(20);
        return view('admin.vipshop.index', compact('vip_shops'));
    }


    public function create()
    {
        $vips = Vip::query()->pluck('title', 'id');
        return view('admin.vipshop.create', compact('vips'));
    }

    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $user_id = $request->input('user');
            $vip_id = $request->input('vip');

            $user = User::find($user_id);
            $vip = Vip::find($vip_id);

            $refId = $request->input('refId');
            $vipShop_refs = VipShop::query()->where('user_id', $user->id)->select('refId')->get();

            if($vipShop_refs->where('refId', $refId)->isNotEmpty()){
                return Redirect::back()->withErrors("کد پیگیری ' $refId ' برای کاربر تکراری است.");
            }

            if ($vip->type == 1) {
                $vipTimeBeforeThis = $viptime = $user->isActive() ? Carbon::parse($user->viptime) : Carbon::now();
                $diff_renew = now()->diffInDays($user->viptime, false);
                $last_viptime = $user->viptime;
            } elseif ($vip->type == 3) {
                $vipTimeBeforeThis = $viptime = $user->isActiveType3() ? Carbon::parse($user->viptimetype3) : Carbon::now();
                $diff_renew = now()->diffInDays($user->viptimetype3, false);
                $last_viptime = $user->viptimetype3;
            } else {
                $vipTimeBeforeThis = $viptime = $user->isActivePro() ? Carbon::parse($user->viptime_pro) : Carbon::now();
                $diff_renew = now()->diffInDays($user->viptime_pro, false);
                $last_viptime = $user->viptime_pro;
            }


            $vipTimeEnd = $viptime->copy()->addDays($vip->days);

            $user->save();

            $vip_shop = new VipShop();
            $vip_shop->payType = 1; // cash type
            //$vip_shop->refId = $request->input('refId');
            $vip_shop->refId = $refId;
            $vip_shop->user_id = $user_id;
            $vip_shop->vip_id = $vip_id;
            $vip_shop->type = $vip->type;

            $vip_shop->vipTimeBeforeThis = $vipTimeBeforeThis;
            $vip_shop->vipTimeEnd = $vipTimeEnd;
            $vip_shop->mobile = $user->mobile;


            if ($request->input('price') == 0) {
                $discount_id = $request->input('discount_id');
                    $vip_shop->pre_price = $vip->price;
                    $vip_shop->price = 0;
            } else {
                $vip_shop->price = $request->input('price');
                $vip_shop->pre_price = $vip->price;
            }

            $previousVipShops = VipShop::query()
                ->select('step', 'situationFlag', 'price')
                ->where(['user_id' => $user_id, 'status' => 1, 'type' => $vip->type])
                ->where('situationFlag', '!=', 2)
                ->orderByDesc('step')
                ->get();

            if ($previousVipShops->isNotEmpty()) {
                if ($request->input('price') != 0) {
                    $notZeroVips = $previousVipShops->where('price', '!=', 0);
                    $vip_shop->diff_renew = $diff_renew;
                    $vip_shop->renew_counter = $notZeroVips->count() + 1;
                }

                $active_vips = $previousVipShops->where('situationFlag', 1);
                if ($active_vips->isNotEmpty()) {
                    $vip_shop->step = $active_vips->first()->step + 1;
                } else {
                    $vip_shop->step = 1; //is the first and Active Vip
                }
            }


            $vip_shop->status = 1; // verified
            $vip_shop->save(); // verified

        });

        return redirect('/admin/vip_shops/create');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $vipshop = VipShop::query()->findOrFail($id);
        $user = User::find($vipshop->user_id);

        return view('admin.vipshop.edit', compact('user', 'vipshop'));
    }

    public function update(Request $request, $id)
    {
        $vip = VipShop::query()->findOrFail($id);
        $vip->refId = $request->input('refId');
        $vip->price = $request->input('price');
        $vip->save();
        Session::flash('update_vipshop', 'اشتراک کاربر با موفقیت ویرایش شد');
        return redirect('admin/vip_shops');
    }

    public function destroy(Request $request, $id)
    {
        //
    }

    public function searchVipShop(Request $request)
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $title = 'لیست خرید اشتراک';
        $search = $request->input('search');
        $vip_shops = VipShop::latest()
            ->where('refId', 'like', '%' . $search . '%')->where('status', 1)
            ->orwhere('mobile', 'like', '%' . $search . '%')->where('status', 1)
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')->where('status', 1)
                    ->orwhere('email', 'like', '%' . $search . '%')->where('status', 1)
                    ->orwhere('instagram', 'like', '%' . $search . '%')->where('status', 1);
            })
            ->with(['user'])->paginate(20);

        return view('admin.vipshop.index', compact('vip_shops'));
    }

}
