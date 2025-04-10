<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response; // Response Components
use App\Traits\ApiResponser; // Use to standardize API responses
use Illuminate\Http\Request;  // Handling HTTP requests in Lumen
use App\Services\User2Service; // User1 Service
use DB;

class User2Controller extends Controller
{
    use ApiResponser;

    public $user2Service;

    public function __construct(User2Service $user2Service)
    {
        $this->user2Service = $user2Service;
    }

    public function index()
    {
        return $this->successResponse($this->user2Service->obtainUsers2());
    }

    public function add(Request $request)
    {
        return $this->successResponse(
            $this->user2Service->createUser2($request->all()), 
            Response::HTTP_CREATED);
    }
    public function getUsers() {
        try {
            return response()->json(User::all(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        return $this->successResponse($this->user2Service->obtainUser2($id));
    }
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->user2Service->editUser2($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user2Service->deleteUser2($id));
    }
}