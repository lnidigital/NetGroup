<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Client;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Guest\GuestRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class AttendanceController extends Controller
{

    protected $settings;
    protected $guests;
    protected $members;

    public function __construct(
        MemberRepositoryContract $members,
        GuestRepositoryContract $guests,
        SettingRepositoryContract $settings
    )
    {
        $this->members = $members;
        $this->guests = $guests;
        $this->settings = $settings;
        // $this->middleware('attendance.create', ['only' => ['create']]);
        // $this->middleware('attendance.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('attendance.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $clients = Client::select(['id', 'name', 'company_name', 'email', 'primary_number']);
        return Datatables::of($clients)
            ->addColumn('namelink', function ($clients) {
                return '<a href="clients/' . $clients->id . '" ">' . $clients->name . '</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'clients.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'clients.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
    	$group_id = 1;

        return view('attendance.create')
            ->withMembers($this->members->getAllMembers($group_id))
            ->withGuests($this->guests->getAllGuests($group_id));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreClientRequest $request)
    {
        $this->clients->create($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * @param Request $vatRequest
     * @return mixed
     */
    public function cvrapiStart(Request $vatRequest)
    {
        return redirect()->back()
            ->with('data', $this->clients->vat($vatRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('clients.show')
            ->withClient($this->clients->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->withInvoices($this->clients->getInvoices($id))
            ->withUsers($this->users->getAllUsersWithDepartments());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('clients.edit')
            ->withClient($this->clients->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->clients->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
        $this->clients->update($id, $request);
        Session()->flash('flash_message', 'Client successfully updated');
        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->clients->destroy($id);

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->clients->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }

}