<?php

namespace App\Http\Controllers\Blog;

use App\Services\Blog\BaseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    private $service;

    public function __construct(
        BaseService $service
    ) {
        $this->service = $service;
    }

    function read()
    {
        try {
            return $this->ok($this->service->read(), '');
        } catch (\Exception $error) {
            info($error);
            return $this->bad_request([], $error->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->service->store($request->validated());
            DB::commit();

            return $this->ok($result, '');
        } catch (\Exception $error) {
            DB::rollBack();
            info($error);

            return $this->bad_request([], $error->getMessage());
        }
    }

    public function get_all()
    {
        $data = $this->service->read();

        return view("index")->with("data", $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("blog.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
