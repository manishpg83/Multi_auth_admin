<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class AdminPlanController extends Controller
{
    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plans = Plan::paginate(10); // Adjust pagination as per your needs
        return view('admin.layouts.plans', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.layouts.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'plan_type' => 'required|string|max:50',
            'plan_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'plan_description' => 'required|string',
        ]);

        // Create the plan using validated data
        Plan::create($validatedData);
        return redirect()->back()
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\View\View
     */
    public function edit(Plan $plan)
    {
        return view('admin.layouts.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Plan $plan)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'plan_type' => 'required|string|max:50',
            'plan_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'plan_description' => 'required|string',
        ]);

        // Update the plan using validated data
        $plan->update($validatedData);
        notyf()->success('Plan updated successfully.');
        return redirect()->back()
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified plan from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        notyf()->success('Plan deleted successfully.');
        return redirect()->back()
            ->with('success', 'Plan deleted successfully.');
    }
}
