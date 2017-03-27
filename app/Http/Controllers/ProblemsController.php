<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProblemFormRequest;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // get all the nerds
        $problems = Problem::all();

        return view('problems.index')
            ->with('problems', $problems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('problems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProblemFormRequest $request)
    {
        //
        $problem = new Problem();
        $solutions = [];

        $problem->n = $request->get('n');
        //$problem->distribution = $request->get('distribution');

        $distribution = $request->get('color');
        echo "<pre>";


        foreach ($distribution['id'] as $k=> $color) {
            for($i=1;$i<=$distribution['cnt'][$k];$i++) {
                $color_arr [] = $color;
            }
        }
        foreach ($this->generate($color_arr) as $combination) {
            $solutions[] = $combination;
        }

        $problem->distribution = serialize($color_arr);
        $problem->solutions = serialize($solutions);

        $problem->save();

        return \Redirect::route('problems.show',
            array($problem->id))
            ->with('message', 'Your problem has been created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem)
    {
       // $problems = Problem::find($id);

        // show the view and pass the nerd to it
        return view('problems.show')
            ->with('problem', $problem);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        //
    }

    public function generate(array $list): \Generator
    {
        if (count($list) > 2) {
            for ($i = 0,$iMax = count($list); $i < $iMax; $i++) {
                $listCopy = $list;

                $entry = array_splice($listCopy, $i, 1);
                foreach ($this->generate($listCopy) as $combination) {
                    $arr = array_merge($entry, $combination);
                    if ($this->isValid($arr,$iMax)) {
                        $hash = sha1(serialize($arr));

                        $nesthash = $this->hashNest($arr,$iMax);
                        if (!isset($hashes[$hash]) && !isset($hashes[$nesthash])) {
                            $hashes[$hash] = 1;
                            $hashes[$nesthash] = 1;
                            yield $arr;
                        }
                    }
                }
            }
        } elseif (count($list) > 0) {
            yield $list;

            if (count($list) > 1) {
                yield array_reverse($list);
            }
        }
    }

    public function isValid($arr,$n) {
        //divide by n
        $slice = array_slice($arr,0,$n);
        $var = true;
        if (count($slice)==0) {
            return true;
        }
        if (count(array_count_values($slice))<=2) {
            $var = $this->isValid(array_slice($arr, 3),$n);

        }else {
            $var = false;
        }

        return $var;


    }
    public function hashNest($arr,$n) {
        //divide by n
        $arrays = array_chunk($arr,$n);
        foreach ($arrays as $key => $value)
            $main_array[$key] = array_sum($value);

        return sha1(serialize($main_array));


    }

}
