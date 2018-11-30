<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Demand;
use App\Models\DemandAttachment;
use App\Models\Bid;
use App\Models\Unit;
use App\Models\City;
use App\Models\Province;
use App\Models\ActivityTime;
use App\User;
use App\Models\Permission;
use App\Models\Transaction;
use App\Drivers\Time;
use Auth;
use App\Drivers\SMS;

use App\Http\Requests\Demand\CreateFree as DemandCreateFreeRequest;
use App\Http\Requests\Demand\CreateUnitUser as DemandCreateUnitUserRequest;
use App\Http\Requests\Demand\CreateUnit as DemandCreateUnitRequest;
use App\Http\Requests\Demand\CreateVisit as DemandCreateVisitRequest;
use App\Http\Requests\Demand\Edit as DemandEditRequest;

use App\Drivers\ZarinPal;

class Demands extends Controller{
    public function index(Request $request){
        $demands = Demand::fetch();
        $links = '';
        $sort = $request->input('sort', '###');

        if($request->has('unit_id') && $request->unit_id != 0)
            $demands = $demands->where('unit_id', $request->unit_id);
        if($request->has('status') && $request->status != 0)
            $demands = $demands->where('status', $request->status);
        if($request->has('province_id') && $request->province_id != 0){
            if($request->has('city_id') && $request->city_id != 0){
                $city_id = $request->city_id;
                $demands = $demands->whereHas('unit', function($query) use($city_id){
                    return $query->where('city_id', $city_id);
                });
            }else{
                $province_id = $request->province_id;
                $demands = $demands->whereHas('unit', function($query) use($province_id){
                    return $query->whereHas('city', function($query) use ($province_id){
                        return $query->where('province_id', $province_id);
                    });
                });
            }
        }else{
            if($request->has('city_id') && $request->city_id != 0){
                $city_id = $request->city_id;
                $demands = $demands->whereHas('unit', function($query) use($city_id){
                    return $query->where('city_id', $city_id);
                });
            }
        }
        if($request->has('sort'))
            $demands = $demands->orderBy($request->input('sort'), 'desc');
        $demands = $demands->paginate(10);
        
        return view('panel.demands.index', [
        'demands' => $demands,
        'units'       => Auth::user()->units,
        'cities'      => City::all(),
        'provinces'   => Province::all(),
        'links'       => $links,
        'sort'        => $sort,
        'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
        'filters'     => [
            'unit_id'     => $request->input('unit_id', ''),
            'province_id' => $request->input('province_id', ''),
            'city_id'     => $request->input('city_id', ''),
            'status'      => $request->input('status'),
        ],
        ]);
    }
    public function createFree(Request $request){
        return view('panel.demands.create.free');
    }
    public function createUnitUser(Request $request, Unit $unit, User $user){
        return view('panel.demands.create.unit_user', [
            'unit'  => $unit,
            'user'  => $user,
        ]);
    }
    public function createUnit(Request $request, Unit $unit){
        return view('panel.demands.create.unit', [
            'unit'  => $unit,
        ]);
    }
    public function createVisit(Request $request, ActivityTime $activity_time, $day){
        if(intval(Time::jdate('w', $day, '', 'Asia/Tehran', 'en'))+1 != $activity_time->day_of_week)
            abort(404);
        // return $day;
        $hour = intval(Time::jdate('H', $day, '', 'Asia/Tehran', 'en'));
        $minute = intval(Time::jdate('i', $day, '', 'Asia/Tehran', 'en'));
        $day -= $hour * 3600 + $minute * 60;
        return view('panel.demands.create.visit', [
            'activity_time' => $activity_time,
            'date'  => Time::jdate('y/m/d', $day),
            'day'   => $day,
        ]);
    }
    public function storeFree(DemandCreateFreeRequest $request){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $inputs['patient_id'] = Auth::user()->id;
        $demand = Demand::create($inputs);
        if($request->hasFile('image')){
            $image = Storage::disk('public')->put('/demands', $request->file('image'));
            DemandAttachment::create([
                'demand_id' => $demand->id,
                'image'     => $image,
            ]);
        }
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }
    public function storeUnitUser(DemandCreateUnitUserRequest $request){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $inputs['patient_id'] = Auth::user()->id;
        $demand = Demand::create($inputs);
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }

    public function storeUnit(DemandCreateUnitRequest $request){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $inputs['patient_id'] = Auth::user()->id;
        $demand = Demand::create($inputs);
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }

    public function storeVisit(DemandCreateVisitRequest $request, ActivityTime $activity_time, $day){
        if(intval(Time::jdate('w', $day, '', 'Asia/Tehran', 'en'))+1 != $activity_time->day_of_week)
            abort(404);
        $demand = new Demand;
        $demand->description = $request->description;
        $demand->start_time = $day + $activity_time->start_time;
        $demand->end_time = $day + $activity_time->finish_time;
        $demand->patient_id = Auth::user()->id;
        if($activity_time->just_in_unit_visit == ActivityTime::IN_UNIT)
            $demand->address_id = 0;
        else 
            $demand->address_id = $request->input('address_id', '0');
        $demand->unit_id = $activity_time->unit_user->unit_id;
        $demand->user_id = $activity_time->unit_user->user_id;
        $demand->asap = 0;
        if($activity_time->default_deposit == 0){
            $demand->status = Demand::IN_PROGRESS;
            $demand->save();
            $bid = new Bid;
            $bid->demand_id = $demand->id;
            $bid->unit_id = $demand->unit_id;
            $bid->user_id = $demand->user_id;
            $bid->status = Bid::ACCEPTED;
            $bid->description = env('BID_DEFAULT_DESCRIPTION');
            $bid->unit_accepted = 1;
            $bid->user_accepted = 1;
            $bid->patient_accepted = 0;
            $bid->price = $activity_time->default_price;
            $bid->deposit = $activity_time->default_deposit;
            $bid->date = $demand->start_time;
            $bid->save();
            Permission::create([
                'requester_id'  => $demand->user_id,
                'patient_id'    => $demand->patient_id,
                'status'        => Permission::ACCEPTED,
            ]);
            $transaction = Transaction::create([
                'src_id'    => $demand->patient_id,
                'dst_id'    => $demand->unit_id,
                'comission' => $demand->unit->comission,
                'amount'    => $bid->price - $bid->deposit,
                'type'      => Transaction::BID_REMAIN_PAY,
                'status'    => Transaction::PENDING,
                'pay_type'  => Transaction::OFFLINE_PAY,
                'authority' => 'NuLL',
                'currency'  => 'tmn',
                'target'    => $bid->id,
                'date'      => $bid->date,
            ]);
            SMS::sendNewVisitMessage($bid);
            return redirect()->route('panel.bids.show', ['bid' => $bid]);
        }else{
            $demand->status = Demand::DEPOSIT_PAY;
            $demand->save();
            $bid = new Bid;
            $bid->demand_id = $demand->id;
            $bid->unit_id = $demand->unit_id;
            $bid->user_id = $demand->user_id;
            $bid->status = Bid::PENDING;
            $bid->description = env('BID_DEFAULT_DESCRIPTION');
            $bid->unit_accepted = 1;
            $bid->user_accepted = 1;
            $bid->patient_accepted = 0;
            $bid->price = $activity_time->default_price;
            $bid->deposit = $activity_time->default_deposit;
            $bid->date = $demand->start_time;
            $bid->save();
            $authority = ZarinPal::generate(
                $bid->deposit, 
                $bid->unit->complete_title . ' - ' . $bid->user->full_name, 
                route('panel.payments.bids.deposit.verify')
            );
            Transaction::create([
                'target'    => $bid->id,
                'src_id'    => Auth::user()->id,
                'dst_id'    => $bid->unit_id,
                'comission' => $bid->unit->comission,
                'amount'    => $bid->deposit,
                'type'      => Transaction::BID_DEPOSIT_PAY,
                'authority' => $authority,
                'currency'  => 'tmn',
                'pay_type'  => TRANSACTION::ONLINE_PAY,
                'date'      => time(),
            ]);
            $pay_link = ZarinPal::generateLink($authority);
            return redirect($pay_link);
        }
        return $demand;
        return $request->all();
    }

    public function edit(Request $request, Demand $demand){
        return view('panel.demands.edit', ['demand' => $demand]);
    }
    public function update(DemandEditRequest $request, Demand $demand){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $demand = $demand->fill($inputs)->save();
        if($request->hasFile('image')){
            DemandAttachment::where('demand_id', $demand->id)->delete();
            $image = Storage::disk('public')->put('/demands', $request->file('image'));
            DemandAttachment::create([
                'demand_id' => $demand->id,
                'image'     => $image,
            ]);
        }
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }
    public function show(Demand $demand){
        return view('panel.demands.show', ['demand' => $demand]);
    }
    public function destroy(Demand $demand){

    }
}
