<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response; // Response Components
use App\Traits\ApiResponser; // Use to standardize API responses
use Illuminate\Http\Request;  // Handling HTTP requests in Lumen
use App\Services\User1Service; // User1 Service
use DB;

class User1Controller extends Controller
{
    use ApiResponser;

    public $user1Service;

    public function __construct(User1Service $user1Service)
    {
        $this->user1Service = $user1Service;
    }

    public function index()
    {
        return $this->successResponse($this->user1Service->obtainUsers1());
    }

    public function add(Request $request)
    {
        return $this->successResponse($this->user1Service->createUser1($request->all()), Response::HTTP_CREATED);
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
        return $this->successResponse($this->user1Service->obtainUser1($id));
    }
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->user1Service->editUser1($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }
}