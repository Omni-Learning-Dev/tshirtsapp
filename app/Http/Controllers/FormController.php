<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Show T-Shirt form page
     *
     * @return \Illuminate\View\View
     */
    public function tShirtForm()
    {
        return view('forms.t-shirt-form');
    }

    /**
     * Process T-Shirt form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tShirtOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|in:XS,S,M,L,XL,XXL',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database
        // For example:
        // Order::create($validated);

        // Here you could send email notification
        // For example:
        // Mail::to($validated['email'])->send(new OrderConfirmation($validated));

        return redirect()->back()->with('message', 'T-Shirt order placed successfully!');
    }

    /**
     * Show Vests form page
     *
     * @return \Illuminate\View\View
     */
    public function vestsForm()
    {
        return view('forms.vests-form');
    }

    /**
     * Process Vests form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vestOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|in:XS,S,M,L,XL,XXL',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database
        // For example:
        // Order::create($validated);

        return redirect()->back()->with('message', 'Puffer Vest order placed successfully!');
    }

    /**
     * Show Jackets form page
     *
     * @return \Illuminate\View\View
     */
    public function jacketsForm()
    {
        return view('forms.jackets-form');
    }

    /**
     * Process Jackets form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jacketOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|in:XS,S,M,L,XL,XXL',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database

        return redirect()->back()->with('message', 'Jacket order placed successfully!');
    }

    /**
     * Show Cap form page
     *
     * @return \Illuminate\View\View
     */
    public function capForm()
    {
        return view('forms.cap-form');
    }

    /**
     * Process Cap form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function capOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database

        return redirect()->back()->with('message', 'Cap order placed successfully!');
    }

    /**
     * Show Hoodies form page
     *
     * @return \Illuminate\View\View
     */
    public function hoodiesForm()
    {
        return view('forms.hoodies-form');
    }

    /**
     * Process Hoodie form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hoodieOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|in:XS,S,M,L,XL,XXL',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database

        return redirect()->back()->with('message', 'Hoodie order placed successfully!');
    }

    /**
     * Show Golf T-Shirt form page
     *
     * @return \Illuminate\View\View
     */
    public function golfTShirtForm()
    {
        return view('forms.golf-t-shirt-form');
    }

    /**
     * Process Golf T-Shirt form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function golfTShirtOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|in:XS,S,M,L,XL,XXL',
            'color' => 'required',
            'customization' => 'sometimes|boolean',
            'logo' => $request->has('customization') ? 'required|image|max:1024' : 'nullable',
            'notes' => 'nullable|string|max:500',
        ]);

        // Process the logo upload if exists
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Here you would save the order to database

        return redirect()->back()->with('message', 'Golf T-Shirt order placed successfully!');
    }
}
