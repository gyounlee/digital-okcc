<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Config;

use App\Code;
use App\Department_Tree;
use App\Http\Services\Log\SystemLog;

class DepartmentTreesController extends Controller {
    private $TABLE_NAME = "DEPARTMENT_TREES";

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $parent_id = $request->parent_id;
        // get all records of department_trees table with code table
        $result = Department_Tree::where('parent_id', $parent_id)->with(['codeByChildId'])->orderBy('id', 'ASC')->get();

        $lists = array();
        foreach ($result as $value) {
            array_push($lists, $this->reinforceTable($value));
        }

        $result = array("result" => $lists);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $result = Department_Tree::create($request->all());
            SystemLog::write(Config::get('app.admin.logInsert'), $this->TABLE_NAME . ' [ID] ' . $result->id);
            return response()->json([ 'result' => $result ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Department_Tree::find($id)->delete();
            SystemLog::write(Config::get('app.admin.logDelete'), $this->TABLE_NAME . ' [ID] ' . $id);
            return response()->json([ 'message' => 'DELETED!' ], 200);
        } catch (Exception $e) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
        }
    }
 
    /**
     * get code lists except codes already registered as children of a parent in department tree.
     */
    public function getcodes_notin_child(Request $request) {
        // get code records that was already saved
        $currentLists = Department_Tree::where('parent_id', $request->parent_id)->pluck('child_id')->all();
        $codes = Code::where('code_category_id', $request->category_id)->whereNotIn('id', $currentLists)->get();
        return response()->json(array("codes" => json_decode(json_encode($codes), true)));
    }

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($value) {
        $temp['id'] = $value->id;
        $temp['child_id'] = $value->codeByChildId->id;
        $temp['child_txt'] = $value->codeByChildId->txt;
        $temp['child_memo'] = $value->codeByChildId->memo;
        return $temp;
    }
}
