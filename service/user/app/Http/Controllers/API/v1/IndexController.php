<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index(Request $request)
  {
    $uri = $request->url();
    $data = array('doc' => $uri . '/documentation');
    return response()->json([
      'message' => 'Welcome to api service user management',
      'data' => $data
    ]);
  }
}
